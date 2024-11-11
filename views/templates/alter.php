<?php

/**
 * @var App\Models\Category [] $categories
 */
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="es">

<?php render('templates/components/head') ?>

<body>
    <header>
        <div class="main-h">
            <div class="logo">
                <a href="<?= getLogoHref() ?>">
                    <img class="LogoEme" src="<?= asset("/img/icons/logo.png") ?>" alt="logo de la empresa" />
                </a>
            </div>
            <nav class="iconos">

                <div class="TextoIcono" id="user-menu">
                    <img src="<?= asset("/img/icons/usuario_icono.png") ?>" class="icono" alt="Usuario" />
                    <br /><?= getUser('username') ?? "Usuario" ?>
                    <div class="dropdown-content" style="display: none;">
                        <?php if (getUser('role') != 'guest') : ?>
                            <div class="user-data" id="user-dropdown" style="display: block;">
                                <a href="/settings">Configuracion</a>
                                <a id="logout-btn">Cerrar sesión</a>
                            </div>
                        <?php else : ?>
                            <div class="register-login" id="register-login">
                                <a href="/register/buyer">Registrarse</a>
                                <a href="/login">Ingresar</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (getUser('role') === 'buyer'): ?>
                    <div class=" TextoIcono" id="cart-menu">
                        <img src="<?= asset("/img/icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                        <br />Carrito
                        <div class="dropdown-content" style="display: none;">
                            <a href="/cart">Carrito</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div hidden class=" TextoIcono" id="cart-menu">
                        <img src="<?= asset("/img/icons/carrito_icono.png") ?>" class="icono" alt="Usuario" />
                        <br />Carrito
                        <div class="dropdown-content" style="display: none;">
                            <a href="/cart">Carrito</a>
                        </div>
                    <?php endif; ?>
            </nav>
        </div>
        <ul class="snd-h">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="categoriesDropdown">Categorias</a>
                <div class="dropdown-content" id="categoriesMenu">
                    <?php foreach ($categories as $category): ?>
                        <a href="/category/<?= $category->id ?>"><?= $category->name ?></a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="dropdown"><a href="#">Ofertas</a></li>
            <li class="dropdown"><a href="#">Cupones</a></li>
            <li class="dropdown">
                <?php if (getUser('role') === 'seller'): ?>
                    <a href="#">Vender</a>
                <?php else: ?>
                    <a href="#">Próximas ofertas</a>
                <?php endif; ?>
            </li>

            <li class="dropdown"><a href="#">Ayuda</a></li>
        </ul>
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