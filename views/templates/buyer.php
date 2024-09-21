<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // recorrer meta tags
    ?>
    <?php
    loadCSS();
    loadCSS('components/categories');
    loadCSS('components/carrousel');
    loadCSS('components/top-header');
    loadCSS('components/footer');
    ?>
    <?php
    foreach ($this->styles as $style) {
        loadCSS($style);
    }
    ?>
    <script type="module" src="<?= asset('/js/main.js') ?>"></script>
    <script type="module" src="<?= asset('/js/components/carrousel.js') ?>"></script>
    <script type="module" src="<?= asset('/js/components/categories.js') ?>"></script>    <?php
    foreach ($this->scripts as $script) {
        echo "<script";

        // Verifica si el tipo de script está definido
        if (!empty($script['type'])) {
            echo " type='{$script['type']}'";
        }

        // Agrega el atributo src
        echo " src='" . asset($script['src']) . "'";

        // Verifica si el atributo 'defer' está presente y es verdadero
        if (!empty($script['defer'])) {
            echo " defer";
        }

        // Cierra la etiqueta de script
        echo "></script>";
    }
    ?>

    <title><?= $title ?></title>
</head>

<body>
    <header>
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
                        <div class="user-data" id="user-dropdown" style="display: block;">
                            <a href="/settings">Configuracion</a>
                            <form action="/logout" method="post" id='logout-form'>
                                <a id="logout-btn">Cerrar sesión</a>
                            </form>
                            <script>
                                const logoutForm = document.getElementById('logout-form')
                                document.getElementById('logout-btn').addEventListener('click', () => {
                                    logoutForm.submit()
                                })
                            </script>
                        </div>
                    </div>
                </div>

                <div class=" TextoIcono" id="cart-menu">
                    <img src="<?= loadIMG("icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                    <br />Carrito
                    <div class="dropdown-content" style="display: none;">
                        <a href="/cart">Carrito</a>
                        <div class="shopping" id="shopping">
                            <a href="/shopping-history">Compras</a>
                        </div>
                        <a href="/search-history">Historial</a>

                    </div>
                </div>

                <a class="TextoIcono" id="user-favorites" href="/favorites">
                    <img src="<?= loadIMG("icons/favorito-papel-corazon.png") ?>" class="icono" alt="Favoritos" />
                    <br />Favoritos
                </a>


            </nav>
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="categoriesDropdown">Categorías</a>
                    <div class="dropdown-content" id="categoriesMenu">
                        <a href="#">Electrónicos</a>
                        <a href="#">Hogar y Muebles</a>
                        <a href="#">Moda</a>
                        <a href="#">Deportes y Fitness</a>
                        <a href="#">Herramientas</a>
                        <a href="#">Construcción</a>
                        <a href="#">Industrias y Oficinas</a>
                        <a href="#">Accesorios para Vehículos</a>
                        <a href="#">Juguetes y Bebés</a>
                        <a href="#">Salud y Equipamiento Médico</a>
                        <a href="#">Belleza y Cuidado Personal</a>
                    </div>
                </li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Cupones</a></li>
                <li><a href="#">Historial de compras</a></li>
                <li><a href="#">Ayuda</a></li>
            </ul>
        </div>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer class="footer">
        <div class="top-container">
            <div class="inner-div" id="contact-section">
                <p>
                    Contacto <br />
                    Cel: 0965565 <br />
                    Tel: 22099878 <br />
                    <a class="mailto" href="mailto:emecommerceoficial@gmail.com"> Correo: emecomerciooficial@gmail.com
                    </a>
                </p>
            </div>
            <div class="inner-div" id="about-section">
                Sobre Nosotros <br />
                - <br />
                - <br />
                -
            </div>
            <div class="inner-div" id="locales-section">
                Locales <br />
                - <br />
                - <br />
                -
            </div>
        </div>
        <div class="bottom-div">
        <a class="contactoa" href="/terms-and-conditions" href="#about-section">Terminos y condiciones</a> 
            <p>@ TODOS LOS DERECHOS RESERVADOS EME COMERCIO</p>
        </div>
    </footer>
</body>

</html>