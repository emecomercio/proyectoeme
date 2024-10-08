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