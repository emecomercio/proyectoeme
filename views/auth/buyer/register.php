<form class="auth-form" method="post">
    <h1>Registrarse</h1>
    <input type="text" id="username" name="username" placeholder="Nombre de usuario" require>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <input type="password" id="password-check" name="password-check" placeholder="Confirmar contraseña" required>
    <div class="terms-and-conditions">
        <input type="checkbox" required name="checkbox">
        <p>He leido y acepto los <a href="/terms-and-conditions">Terminos y condiciones </a></p>
    </div>
    <button type="submit">Registrarse</button>
    <a href="/register/seller">Registrarse como empresa</a>
</form>

<script type="module" src="">
    document.querySelector('.auth-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario
        // Crear un objeto FormData con los datos del formulario
        const formData = new FormData(this);

        // Opcional: Convertir FormData a un objeto JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Enviar los datos con fetch
        fetch('/api/users', {
                method: 'POST', // o el método que necesites
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>