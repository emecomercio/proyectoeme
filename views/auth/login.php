<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
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