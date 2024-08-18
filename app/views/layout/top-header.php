<header>
    <nav class="contacto">
        <a class="contactoa" href="#contact-section">Contacto</a>
        <a class="contactoa" href="terms-and-conditions" href="#about-section">Terminos y condiciones</a>
        <a class="contactoa" href="#locales-section">Locales</a>
    </nav>
    <div class="header">
        <div class="logo">
            <a href="/">
                <img class="LogoEme" src="<?= loadIMG("icons/logo.png") ?>" alt="logo de la empresa" />
            </a>
        </div>
        <div class="buscador">
            <input type="text" placeholder="buscar" class="BarraBusqueda" />
            <button type="button" class="BotonBusqueda">
                <img class="LogoBusqueda" src="<?= loadIMG("icons/lupa_icono_negro.png") ?>" alt="Buscar" />
            </button>
        </div>
        <nav class="iconos">
            <div class="TextoIcono" id="user-menu">
                <img src="<?= loadIMG("icons/usuario_icono.png") ?>" class="icono" alt="Usuario" />
                <br />Usuario
                <div class="dropdown-content" style="display: none;">
                    <a href="/register-user">Registrarse</a>
                    <a href="/login-user">Ingresar</a>
                    <a href="/dashboard">Datos de usuario</a>
                    <a href="/logout">Cerrar sesión</a>
                </div>
            </div>
            <div class="TextoIcono" id="cart-menu">
                <img src="<?= loadIMG("icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                <br />Carrito
                <div class="dropdown-content" style="display: none;">
                    <a href="/cart">Carrito</a>
                    <a href="">Compras</a>
                    <a href="">Historial</a>
                </div>
            </div>
            <a class="TextoIcono" href="#">
                <img src="<?= loadIMG("icons/favorito-papel-corazon.png") ?>" class="icono" alt="Ubicación" />
                <br />Favoritos
            </a>
        </nav>
    </div>
</header>