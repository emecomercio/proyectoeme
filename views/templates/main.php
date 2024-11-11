<?php

/**
 * @var App\Models\Category [] $categories
 */
$categories = getCategories();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('/css/global.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/6.4.4/css/flag-icons.min.css">

    <?php if ($this->styles) : ?>
        <?php foreach ($this->styles as  $style) : ?>
            <link rel="stylesheet" href="<?= asset($style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <script type="module" src="<?= asset('/js/main.js') ?>"></script>
    <script src="https://unpkg.com/i18next/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
    <?php
    if (isset($this->scripts)) {
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
    }
    ?>

    <title><?= $title . " | EME Comercio" ?></title>
</head>

<body>
    <header>
        <div class="main-h">
            <div class="logo">
                <a href="<?= getLogoHref() ?>">
                    <img class="LogoEme" src="<?= asset("/img/icons/logo.png") ?>" alt="logo de la empresa" />
                </a>
            </div>
            <div class="language-toggle">
                <span class="fi fi-us flag" id="flag-1"></span>
                <span class="fi fi-es flag" id="flag-2"></span>
            </div>
            <?php
            if (getUser('role') == 'guest' || getUser('role') == 'buyer') {
                render('templates/components/searchbar');
            }
            ?>
            <nav class="iconos">

                <div class="TextoIcono" id="user-menu">
                    <img src="<?= asset("/img/icons/usuario_icono.png") ?>" class="icono" alt="Usuario" />
                    <br /><span data-translate="userLabel"><?= getUser('username') ?? "Usuario" ?></span>
                    <div class="dropdown-content" id="user-dropdown-content" style="display: none;">
                        <?php if (getUser('role') == 'guest') : ?>
                            <div class="register-login" id="register-login">
                                <a href="/register/buyer" data-translate="register">Registrarse</a>
                                <a href="/login" data-translate="login">Ingresar</a>
                            </div>
                        <?php else: ?>
                            <div class="user-data" id="user-dropdown" style="display: block;">
                                <a href="/settings" data-translate="settings">Configuracion</a>
                                <a id="logout-btn" data-translate="logout">Cerrar sesión</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (getUser('role') === 'buyer'): ?>
                    <div class="TextoIcono" id="cart-menu">
                        <img src="<?= asset("/img/icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                        <br /><span data-translate="cartLabel">Carrito</span>
                        <div class="dropdown-content" id="Cart-text-content" style="display: none;">
                            <a href="/cart" data-translate="cart">Carrito</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div hidden class="TextoIcono" id="cart-menu">
                        <img src="<?= asset("/img/icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                        <br /><span data-translate="cartLabel">Carrito</span>
                        <div class="dropdown-content" style="display: none;">
                            <a href="/cart" data-translate="cart">Carrito</a>
                        </div>
                    <?php endif; ?>
            </nav>
        </div>
        <ul class="snd-h">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="categoriesDropdown" data-translate="categories">Categorias</a>
                <div class="dropdown-content" id="categoriesMenu">
                    <?php foreach ($categories as $category): ?>
                        <a href="/category/<?= $category->id ?>"><?= $category->name ?></a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="dropdown"><a href="#" data-translate="offers">Ofertas</a></li>
            <li class="dropdown"><a href="#" data-translate="coupons">Cupones</a></li>
            <li class="dropdown"><a href="#" data-translate="help">Ayuda</a></li>
        </ul>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer class="footer">
        <div class="top-container">
            <div class="inner-div" id="contact-section">
                <p>
                    <span data-translate="contact">Contacto</span> <br />
                    <span data-translate="phone">Cel:</span> 0965565 <br />
                    <span data-translate="telephone">Tel:</span> 22099878 <br />
                </p>
            </div>
            <div class="inner-div" id="about-section">
                <span data-translate="socialMedia">Redes sociales</span> <br />
                <a href="https://www.instagram.com/eme.o.ficial/" target="_blank" rel="noopener noreferrer" style="color: white;" data-translate="followInstagram">
                    Síguenos en Instagram
                </a>
                <br />
                <a class="mailto" href="mailto:emecommerceoficial@gmail.com" data-translate="email">Correo: emecomerciooficial@gmail.com</a>
                <br />
                - <br />
            </div>
        </div>
        <div class="bottom-div">
            <a class="contactoa" href="/terms-and-conditions" href="#about-section" data-translate="terms">Términos y condiciones</a>
            <p data-translate="rights">© TODOS LOS DERECHOS RESERVADOS EME COMERCIO</p>
        </div>
    </footer>
</body>

</html>