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
            fetch('/users')
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

        // Llama a la función para obtener los usuarios al cargar la página        fetchUsers();
    </script>
</body>

</html>