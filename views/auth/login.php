<form class="auth-form" method="post">
    <h1>Iniciar sesión</h1>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <a class="forgot-password" href="/forgot-password">¿Olvidaste tu contraseña?</a>
    <button type="submit" id="loginButton">Iniciar sesión</button>
</form>
<span class="auth-error error-message" style="display: none;"></span>
<?php
if ($msg != '') {
    echo '<div class="error-message">' . $msg . '</div>';
}
?>
<script>
    const errorBox = document.querySelector(".auth-error")

    document.querySelector('.auth-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario

        const formData = new FormData(this);

        // Convertir FormData a un objeto JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Enviar los datos con fetch
        fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success') {
                    // Redirigir al homepage si el inicio de sesión fue exitoso
                    result.data.role == 'seller' ? window.location.href = '/dashboard' : window.location.href = '/';
                } else {
                    console.log('Error de autenticación:', result.message);
                    errorBox.textContent = result.message;
                    errorBox.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>