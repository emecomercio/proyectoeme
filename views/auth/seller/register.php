<form class="auth-form" method="post">
    <h1>Registrarse</h1>
    <input type="hidden" name="role" value="seller">
    <input type="text" id="name" name="name" placeholder="Nombre de la empresa" required>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="text" id="document-number" name="document-number" placeholder="Documento Tributario" required>
    <div class="direction">
        <h3>Direccion</h3>
        <input type="text" name="main-street" placeholder="Calle prinncipal" required>
        <input type="text" name="corner" placeholder="Esquina" required>
        <input type="number" name="number-hause" placeholder="Numero">
    </div>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <input type="password" id="password-check" name="password-check" placeholder="Confirmar contraseña" required>
    <div class="terms-and-conditions">
        <input type="checkbox" required name="checkbox">
        <p>He leido y acepto los <a href="/terms-and-conditions">Terminos y condiciones </a></p>
    </div>
    <button type="submit">Registrarse</button>
    <a href="/register/buyer">Registrarse como comprador</a>
</form>
<span class="auth-error error-message" style="display: none;"></span>

<script>
    const errorBox = document.querySelector(".auth-error")
    document.querySelector('.auth-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario
        // Crear un objeto FormData con los datos del formulario
        const formData = new FormData(this);

        // Opcional: Convertir FormData a un objeto JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        console.log(data)
        // Enviar los datos con fetch
        fetch('/api/register', {
                method: 'POST', // o el método que necesites
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.status == "success") {
                    window.location.href = "/login"
                } else {
                    errorBox.style.display = "block"
                    errorBox.textContent = result.message
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>