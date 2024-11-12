<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
<form class="auth-form" method="post">
    <h1 data-translate="registerTitle">Registrarse</h1>
    <input type="hidden" id="role" name="role" value="buyer">
    <input type="text" id="name" name="name" placeholder="Nombre Completo" required data-translate="namePlaceholder">
    <input type="email" id="email" name="email" placeholder="Correo electronico" required data-translate="emailPlaceholder">
    <input type="text" id="document-number" name="document-number" placeholder="Ingresa tu documento de identidad" required data-translate="documentPlaceholder">
    <input type="password" id="password" name="password" placeholder="Contraseña"required data-translate="passwordPlaceholder">
    <input type="password" id="password-check" name="password-check" placeholder="Confirmar contraseña" required data-translate="passwordCheckPlaceholder">
    <div class="terms-and-conditions">
        <input type="checkbox" required name="checkbox">
        <p data-translate="termsText">He leído y acepto los <a href="/terms-and-conditions" data-translate="termsLink">Términos y condiciones</a></p>
    </div>
    <button type="submit" data-translate="registerButton">Registrarse</button>
    <a href="/register/seller" data-translate="registerSeller">Registrarse como empresa</a>
</form>
<span class="auth-error error-message" style="display: none;" data-translate="authError"></span>
