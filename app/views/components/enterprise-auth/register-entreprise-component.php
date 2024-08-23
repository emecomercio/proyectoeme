<form class="auth-form" action="/register-user" method="post">
    <?= htmlspecialchars($errorMsg) ?>
    <h1>Registrarse</h1>
    <input type="hidden" name="user-type" value="enterprise">
    <input type="text" id="company-name" name="company-name" placeholder="Nombre de la empresa" required>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="text" id="rut" name="rut" placeholder="RUT" required>
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
    <a href="/register-user">Registrarse como usuario</a>
</form>