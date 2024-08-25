<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Example</title>
</head>

<body>
    <h1>Users List</h1>
    <ul id="user-list"></ul>

    <script>
        // Función para obtener los usuarios y mostrarlos
        function fetchUsers() {
            // Realiza una solicitud GET a la URL /users
            fetch('/users')
                .then(response => {
                    // Verifica si la respuesta es "ok" (código de estado HTTP 200-299)
                    if (!response.ok) {
                        // Si no es "ok", lanza un error para manejarlo más adelante
                        throw new Error('Network response was not ok');
                    }
                    // Si la respuesta es "ok", convierte los datos a JSON
                    return response.json();
                })
                .then(users => {
                    // Aquí tienes los datos en la variable "users"
                    // Puedes usar estos datos para cualquier propósito (como mostrar en la UI)
                    // Por ejemplo
                    console.log(users);
                })
                .catch(error => {
                    // Maneja cualquier error que haya ocurrido en la solicitud o en el procesamiento
                    console.error('Error fetching users:', error);
                    // Aquí podrías manejar el error, como mostrar un mensaje al usuario
                });
        }


        function fetchUsers2() {
            // Realiza una solicitud GET a la URL /users
            fetch('/users')
                .then(response => {
                    // Verifica si la respuesta es "ok" (código de estado HTTP 200-299)
                    if (!response.ok) {
                        // Si no es "ok", lanza un error para manejarlo más adelante
                        throw new Error('Network response was not ok');
                    }
                    // Si la respuesta es "ok", convierte los datos a JSON
                    return response.json();
                })
                .then(users => {
                    const userList = document.getElementById('user-list');
                    userList.innerHTML = '';

                    users.forEach(user => {
                        const li = document.createElement('li');
                        li.textContent = `ID: ${user.id}, Name: ${user.username}`;
                        userList.appendChild(li);
                    });
                })
                .catch(error => {
                    // Maneja cualquier error que haya ocurrido en la solicitud o en el procesamiento
                    console.error('Error fetching users:', error);
                    // Aquí podrías manejar el error, como mostrar un mensaje al usuario
                });
        }


        function fetchProducts() {
            fetch('products')
                .then(response => response.json())
                .then(users => {
                    const userList = document.getElementById('user-list');
                    userList.innerHTML = '';

                    users.forEach(user => {
                        const li = document.createElement('li');
                        li.textContent = `ID: ${user.id}, Name: ${user.username}`;
                        userList.appendChild(li);
                    });
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        // Llama a la función para obtener los usuarios al cargar la página
        fetchUsers();
        fetchUsers2();
    </script>
</body>

</html>