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
    loadCSS('components/top-header');
    loadCSS('components/footer');
    ?>
    <?php
    foreach ($this->styles as $style) {
        loadCSS($style);
    }
    ?>

    <script type="module" src="<?= asset('/js/main.js') ?>"></script>
    <?php
    foreach ($this->scripts as $script) {
        echo "<script type='" . $script['type'] . "' src='" . asset($script['src']) . "'></script>";
    }
    ?>
    <title><?= $title ?></title>
</head>

<body>
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
            </div>
            <nav class="iconos">

                <div class="TextoIcono" id="user-menu">
                    <img src="<?= loadIMG("icons/usuario_icono.png") ?>" class="icono" alt="Usuario" />
                    <br /><?= $_SESSION['user_name'] ?? "Usuario" ?>
                    <div class="dropdown-content" style="display: none;">
                        <div class="register-login" id="register-login">
                            <a href="/register">Registrarse</a>
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
            <p>@ TODOS LOS DERECHOS RESERVADOS EME COMERCIO</p>
        </div>
    </footer>
</body>

</html>