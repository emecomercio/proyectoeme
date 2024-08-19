<form class="auth-form" action="/login" method="post">
    <?= htmlspecialchars($errorMsg) ?>
    <h1>Iniciar sesión</h1>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <a class="forgot-password" href="forgot-password">¿Olvidaste tu contraseña?</a>
    <button type="submit" id="loginButton">Iniciar sesión</button>
    <a href="/login-entrepise">Iniciar sesión como empresa</a>
</form>