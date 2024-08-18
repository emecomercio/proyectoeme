<<<<<<< HEAD
<form id="login-form" action="/register-user" method="post">
=======
<form class="auth-form" action="/register-user" method="post">
    <?= htmlspecialchars($errorMsg) ?>
>>>>>>> 6c22829702c2ca1f5f9e65123ffa66eac3ff0df6
    <h1>Registrarse</h1>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <input type="password" id="password-check" name="password-check" placeholder="Confirmar contraseña" required>
    <div class="terms-and-conditions">
        <input type="checkbox" required name="checkbox">
        <p>He leido y acepto los</p>
        <a class="taclink" href="terms-and-conditions">
            <p class="tacp">Terminos y condiciones</p>
        </a>
    </div>
    <button type="submit">Registrarse</button>
    <a href="register-enterprise">Registrarse como empresa</a>
</form>