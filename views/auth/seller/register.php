<form class="auth-form" method="post">
    <h1>Registrarse</h1>
    <input type="hidden" name="role" value="seller">
    <input type="text" id="name" name="name" placeholder="Nombre de la empresa" required>
    <input type="email" id="email" name="email" placeholder="Correo electronico" required>
    <input type="text" id="document-number" name="document-number" placeholder="Documento Tributario" required>
    <!-- <div class="direction">
        <h3>Direccion</h3>
        <input type="text" name="main-street" placeholder="Calle prinncipal" required>
        <input type="text" name="corner" placeholder="Esquina" required>
        <input type="number" name="number-hause" placeholder="Numero">
    </div> -->
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