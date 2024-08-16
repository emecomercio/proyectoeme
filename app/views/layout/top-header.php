<header>
    <nav class="contacto">
        <a class="contactoa" href="#contact-section">Contacto</a>
        <a class="contactoa" href="#about-section">Sobre nosotros</a>
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
                    <a href="register-user">Registrarse</a>
                    <a href="login-user">Ingresar</a>
                    <a href="dashboard">Datos de usuario</a>
                    <a href="">Cerrar sesión</a>
                </div>
            </div>
            <a class="TextoIcono" href="cart">
                <img src="<?= loadIMG("icons/carrito_icono.png") ?>" class="icono" alt="Carrito" />
                <br />Carrito
            </a>
            <a class="TextoIcono" href="#">
                <img src="<?= loadIMG("icons/ubicacion_icono.png") ?>" class="icono" alt="Ubicación" />
                <br />Ubicación
            </a>
        </nav>
    </div>
</header>