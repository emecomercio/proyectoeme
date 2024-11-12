<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
<form class="auth-form" method="post">
    <h1 data-translate="loginTitle">Iniciar sesión</h1>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required data-translate="emailPlaceholder">
    <input type="password" id="password" name="password" placeholder="Contraseña" required data-translate="passwordPlaceholder">
    <a class="forgot-password" href="/forgot-password" data-translate="forgotPassword">¿Olvidaste tu contraseña?</a>
    <a class="forgot-password" href="/register/buyer" data-translate="noAccount">¿No tienes una cuenta? Registrate aquí</a>
    <button type="submit" id="loginButton" data-translate="loginButton">Iniciar sesión</button>
</form>
<span class="auth-error error-message" style="display: none;" data-translate="authError"></span>
<?php
if ($msg != '') {
    echo '<div class="error-message">' . $msg . '</div>';
}
?>
