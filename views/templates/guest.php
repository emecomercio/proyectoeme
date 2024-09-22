<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
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
    <script type="module" src="<?= asset('/js/components/categories.js') ?>"></script>
    <?php
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
                        <div class="register-login" id="register-login">
                            <a href="/register/buyer">Registrarse</a>
                            <a href="/login">Ingresar</a>
                        </div>
                    </div>
                </div>

                <div class=" TextoIcono" id="cart-menu">
                    <img src="<?= loadIMG("icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                    <br />Carrito
                    <div class="dropdown-content" style="display: none;">
                        <a href="/cart">Carrito</a>
                    </div>
                </div>
            </nav>
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="categoriesDropdown">Categorías</a>
                    <div class="dropdown-content" id="categoriesMenu">
                        <?php
                        foreach ($catalogs as $catalog):
                        ?>
                            <a href="/catalog/<?= $catalog['id'] ?>"><?= $catalog['name'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Cupones</a></li>
                <li><a href="#">Proximas ofertas</a></li>

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