<form class="auth-form" action="/login" method="post">
    <?= htmlspecialchars($errorMsg) ?>
    <h1>Iniciar sesión</h1>
    <input type="hidden" name="user-type" value="enterprise">
    <input type="email" id="email" name="email" placeholder="Correo de la empresa" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <a class="forgot-password" href="/forgot-password">¿Olvidaste tu contraseña?</a>
    <button type="submit">Iniciar sesión</button>
    <a href="/login-user">Iniciar sesión como usuario</a>
</form>