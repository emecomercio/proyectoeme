<form class="auth-form" method="post">
    <h1>Registrarse</h1>
    <input type="hidden" id="role" name="role" value="buyer">
    <input type="text" id="name" name="name" placeholder="Nombre Completo" required>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="text" id="document-number" name="document-number" placeholder="Ingresa tu documento de identidad" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <input type="password" id="password-check" name="password-check" placeholder="Confirmar contraseña" required>
    <div class="terms-and-conditions">
        <input type="checkbox" required name="checkbox">
        <p>He leido y acepto los <a href="/terms-and-conditions">Terminos y condiciones </a></p>
    </div>
    <button type="submit">Registrarse</button>
    <a href="/register/seller">Registrarse como empresa</a>
</form>
<span class="auth-error error-message" style="display: none;"></span>

<script>
    const errorBox = document.querySelector(".auth-error")
    document.querySelector('.auth-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario
        // Crear un objeto FormData con los datos del formulario
        const formData = new FormData(this);
        errorBox.innerHTML = '';

        const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        const passwordPattern = /^[A-Za-z\d@$!%*?&]{6,}$/;
        


        // Opcional: Convertir FormData a un objeto JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Validación
        let isValid = true;
        let msg  = ""; 


        // Validar el correo electrónico
        if (!emailPattern.test(data.email)) {
            console.warn("El correo electrónico no es válido.");
            msg =  "El correo electrónico no es válido.";
            isValid = false;
        }

        // Validar la contraseña
        if (!passwordPattern.test(data.password)) {
            console.warn("La contraseña debe tener al menos 6 caracteres.");
            msg =  "La contraseña debe tener al menos 6 caracteres.";
            isValid = false;
        }

        // Validar que las contraseñas coincidan
        if (data.password !== data["password-check"]) {
            console.warn("Las contraseñas no coinciden.");
            msg =  "Las contraseñas no coinciden.";
            isValid = false;
        }

        // Enviar datos a la API si son válidos
        if (isValid) {
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
        } else {
            errorBox.style.display = "block"
            errorBox.textContent = msg
        }
    });
</script>