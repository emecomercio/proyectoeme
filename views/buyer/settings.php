<div class="container">
    <h1>Configuraciones</h1>
    <div class="settings-section">
        <h2>Perfil de Usuario</h2>
        <form>
            <label for="name">Nombre completo:</label>
            <input type="text" id="name" name="name">

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email">

            <label for="phone">Número de teléfono:</label>
            <input type="tel" id="phone" name="phone">

            <label for="profile-picture"> :</label>
            <input type="file" id="profile-picture" name="profile-picture">

            <h3>Configuración de Contraseña</h3>
            <label for="current-password">Contraseña actual:</label>
            <input type="password" id="current-password" name="current-password">

            <label for="new-password">Nueva contraseña:</label>
            <input type="password" id="new-password" name="new-password">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="settings-section">
        <h2>Dirección de Envío</h2>
        <form>
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address">

            <label for="city">Ciudad:</label>
            <input type="text" id="city" name="city">

            <label for="zip">Código postal:</label>
            <input type="text" id="zip" name="zip">

            <label for="country">País:</label>
            <input type="text" id="country" name="country">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="settings-section">
        <h2>Métodos de Pago</h2>
        <form>
            <label for="card-number">Número de tarjeta:</label>
            <input type="text" id="card-number" name="card-number">

            <label for="card-expiry">Fecha de expiración:</label>
            <input type="text" id="card-expiry" name="card-expiry">

            <label for="card-cvc">CVC:</label>
            <input type="text" id="card-cvc" name="card-cvc">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="settings-section">
        <h2>Preferencias de Compra</h2>
        <form>
            <label for="product-preferences">Tipos de productos preferidos:</label>
            <input type="text" id="product-preferences" name="product-preferences">

            <label for="brands">Marcas favoritas:</label>
            <input type="text" id="brands" name="brands">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="settings-section">
        <h2>Configuración de la Cuenta</h2>
        <form>
            <label for="privacy">Configuración de privacidad:</label>
            <select id="privacy" name="privacy">
                <option value="public">Pública</option>
                <option value="private">Privada</option>
            </select>

            <label for="2fa">Autenticación de dos factores:</label>
            <input type="checkbox" id="2fa" name="2fa">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <div class="settings-section">
        <h2>Soporte y Ayuda</h2>
        <form>
            <label for="support-message">Envíanos un mensaje:</label>
            <textarea id="support-message" name="support-message"></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
</div>