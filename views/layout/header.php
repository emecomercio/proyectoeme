<?php
$categories = getCategories();
?>
<header>
    <div class="main-h">
        <div class="logo">
            <a href="/">
                <img class="LogoEme" src="<?= loadIMG("icons/logo.png") ?>" alt="logo de la empresa" />
            </a>
        </div>
        <div class="buscador">
            <input type="search" placeholder="Buscar" class="BarraBusqueda" />
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
    </div>
    <ul class="snd-h">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" id="categoriesDropdown">Categorias</a>
            <div class="dropdown-content" id="categoriesMenu">
                <?php
                foreach ($categories as $category):
                ?>
                    <a href="/catalog/<?= $category['id'] ?>"><?= $category['name'] ?></a>
                <?php endforeach; ?>
            </div>
        </li>
        <li class="dropdown"><a href="#">Ofertas</a></li>
        <li class="dropdown"><a href="#">Cupones</a></li>
        <li class="dropdown"><a href="#">Proximas ofertas</a></li>
        <li class="dropdown"><a href="#">Ayuda</a></li>
    </ul>
</header>