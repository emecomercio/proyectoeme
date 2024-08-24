<header>
    <nav class="contacto">
        <a class="contactoa" href="#contact-section">Contacto</a>
        <a class="contactoa" href="/terms-and-conditions" href="#about-section">Terminos y condiciones</a>
        <a class="contactoa" href="#locales-section">Locales</a>
    </nav>
    <div class="header">
        <div class="logo">
            <a href="/">
                <img class="LogoEme" src="<?= loadIMG("icons/logo.png") ?>" alt="logo de la empresa" />
            </a>
        </div>
        <div class="buscador">
            <input type="search" placeholder="buscar" class="BarraBusqueda" />
            <button type="button" class="BotonBusqueda">
                <img class="LogoBusqueda" src="<?= loadIMG("icons/lupa_icono_negro.png") ?>" alt="Buscar" />
            </button>
        </div>
        <nav class="iconos">

            <div class="TextoIcono" id="user-menu">
                <img src="<?= loadIMG("icons/usuario_icono.png") ?>" class="icono" alt="Usuario" />
                <br /><?= $_SESSION['user_name'] ?? "Usuario" ?>
                <div class="dropdown-content" style="display: none;">
                    <div class="register-login" id="register-login">
                        <a href="/register-user">Registrarse</a>
                        <a href="/login-user">Ingresar</a>
                    </div>
                    <div class="user-data" id="user-dropdown">
                        <a href="/dashboard">Datos de usuario</a>
                        <a href="">Configuracion</a>
                        <a href="/logout" onclick="hide();">Cerrar sesión</a>
                    </div>
                </div>
            </div>

            <div class="TextoIcono" id="cart-menu">
                <img src="<?= loadIMG("icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                <br />Carrito
                <div class="dropdown-content" style="display: none;">
                    <a href="/cart">Carrito</a>
                    <div class="shopping" id="shopping">
                        <a href="/shopping">Compras</a>
                    </div>
                    <a href="/history">Historial</a>

                </div>
            </div>

            <a class="TextoIcono" id="user-favorites" href="/favorites">
                <img src="<?= loadIMG("icons/favorito-papel-corazon.png") ?>" class="icono" alt="Favoritos" />
                <br />Favoritos
            </a>


        </nav>
    </div>
</header>