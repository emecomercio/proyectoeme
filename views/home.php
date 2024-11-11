<?php render("feedback/alert-cookie"); ?>
<div class="carousel">
    <div class="carousel-inner">
        <div class="carousel-item">
            <a href="/register/buyer">
                <img src="<?= getCarouselHref() ?>" alt="Image 1">
            </a>
        </div>
        <div class="carousel-item">
            <img src="/img/Carrousel/super_ofertas.png" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="/img/Carrousel/super_ofertas2.png" alt="Image 3">
        </div>
    </div>
    <button class="carousel-control prev">&lt;</button>
    <button class="carousel-control next">&gt;</button>
</div>
<section class="presentation">
    <div class="carousel-container">
        <div class="carousel-header">
            <h2 class="carrusel_title_product" data-translate="most-requested-gardening">Lo mas solicitado en jardineria</h2>
            <a href="#" data-translate="go-to-best-sellers">Ir a Más vendidos</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product->variants)) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product->variants) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product->variants[$randomIndex];
                            // Renderizar la variante aleatoria
                            render("products/components/product-card", ["product" => $randomVariant, "parent" =>  $product,  "variantNumber" =>  $randomIndex]);
                        }
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <button class="carousel_control_product prev">&lt;</button>
        <button class="carousel_control_product next">&gt;</button>
    </div>
    <div class="carousel-container">
        <div class="carousel-header">
            <h2 class="carrusel_title_product" data-translate="most-requested-appliances">Más solicitados en electrodomesticos</h2>
            <a href="#" data-translate="go-to-appliances">Ir a electrodomésticos</a>
        </div>
        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product->variants)) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product->variants) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product->variants[$randomIndex];
                            // Renderizar la variante aleatoria
                            render("products/components/product-card", ["product" => $randomVariant, "parent" =>  $product,  "variantNumber" =>  $randomIndex]);
                        }
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <button class="carousel_control_product prev">&lt;</button>
        <button class="carousel_control_product next">&gt;</button>
    </div>
    <div class="carousel-container">
        <div class="carousel-header">
            <h2 class="carrusel_title_product" data-translate="this-may-interest-you">Esto podría interesarte</h2>
            <a href="#" data-translate="see-more">Ver más</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product->variants)) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product->variants) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product->variants[$randomIndex];
                            // Renderizar la variante aleatoria
                            render("products/components/product-card", ["product" => $randomVariant, "parent" =>  $product,  "variantNumber" =>  $randomIndex]);
                        }
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <button class="carousel_control_product prev">&lt;</button>
        <button class="carousel_control_product next">&gt;</button>
    </div>
    <div class="product-banner">
        <div class="banner-left">
            <img src="/img/cards/ropa.jpg" alt="Lavadoras Greenwind" class="product-image-banner">
        </div>
        <div class="banner-right">
            <h4 data-translate="wash-dry">LAVADO Y SECADO</h4>
            <h1 data-translate="shipping-all-country">ENVÍOS A TODO EL PAÍS</h1>
            <a href="#" class="cta-button" data-translate="see-more">VER MÁS</a>
        </div>
    </div>

    <div class="carousel-container">
        <div class="carousel-header">
            <h2 class="carrusel_title_product" data-translate="this-may-interest-you">Esto podría interesarte</h2>
            <a href="#" data-translate="see-more">Ver más</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product->variants)) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product->variants) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product->variants[$randomIndex];
                            // Renderizar la variante aleatoria
                            render("products/components/product-card", ["product" => $randomVariant, "parent" =>  $product,  "variantNumber" =>  $randomIndex]);
                        }
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <button class="carousel_control_product prev">&lt;</button>
        <button class="carousel_control_product next">&gt;</button>
    </div>

    <div class="promo-card-section">
        <div class="promo-item">
            <div class="promo-description">
                <p class="promo-heading" data-translate="super-sale">¡LLEGÓ SUPEROFERTA!</p>
                <h3 class="promo-main-title" data-translate="your-stock-easier">TU SURTIDO MÁS FÁCIL Y RÁPIDO</h3>
                <a href="#" class="promo-btn" data-translate="see-more">Ver más</a>
            </div>
            <div class="promo-image-section">
                <img src="https://via.placeholder.com/150" alt="Productos Supermercado">
            </div>
        </div>

        <div class="promo-item">
            <div class="promo-description">
                <p class="promo-heading" data-translate="enjoy-your-home">DISFRUTÁ DE TU HOGAR</p>
                <h3 class="promo-main-title" data-translate="highlighted-chairs">SILLAS Y SILLONES DESTACADOS</h3>
                <a href="#" class="promo-btn" data-translate="see-more">Ver más</a>
            </div>
            <div class="promo-image-section">
                <img src="   " alt="Sillas y sillones">
            </div>
        </div>
    </div>

</section>

<div class="container_category">
    <div class="header_category">
        <h2 data-translate="categories">Categorías</h2>
        <a href="#" data-translate="show-all-categories">Mostrar todas las categorías</a>
    </div>
    <div class="categories_category">
        <div class="category">
            <img src="../img/toggle_categories/car_category.avif" alt="Autos, Motos y Otros">
            <span data-translate="cars-motorcycles">Autos, Motos y Otros</span>
        </div>
        <div class="category">
            <img src="../img/toggle_categories/phone_category.jpg" alt="Celulares y Telefonía">
            <span data-translate="mobile-phones">Celulares y Telefonía</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Electrodomésticos y Aires Ac.">
            <span data-translate="home-appliances">Electrodomésticos y Aires Ac.</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Herramientas">
            <span data-translate="tools">Herramientas</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Accesorios para Vehículos">
            <span data-translate="vehicle-accessories">Accesorios para Vehículos</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Ropa, Calzados y Accesorios">
            <span data-translate="clothing-footwear-accessories">Ropa, Calzados y Accesorios</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Deportes y Fitness">
            <span data-translate="sports-fitness">Deportes y Fitness</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Belleza y Cuidado Personal">
            <span data-translate="beauty-personal-care">Belleza y Cuidado Personal</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Hogar, Muebles y Jardín">
            <span data-translate="home-furniture-garden">Hogar, Muebles y Jardín</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Computación">
            <span data-translate="computing">Computación</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Inmuebles">
            <span data-translate="real-estate">Inmuebles</span>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/80" alt="Electrónica, Audio y Video">
            <span data-translate="electronics-audio-video">Electrónica, Audio y Video</span>
        </div>
    </div>
    <div class="nav_arrow_category">
        <button>&#8249;</button>
        <button>&#8250;</button>
    </div>
</div>