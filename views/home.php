<?php

/** @var array $products
 */
?>
<?php render("feedback/alert-cookie") ?>
<div class="carousel">
    <div class="carousel-inner">
        <div class="carousel-item">
            <a href="/register/buyer">
                <img src="/img/Carrousel/Unete_ahora.png" alt="Image 1">
            </a>
        </div>
        <div class="carousel-item">
            <img src="/img/Carrousel/super_ofertas.png" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="/placeholder.svg?height=400&width=600" alt="Image 3">
        </div>
    </div>
    <button class="carousel-control prev">&lt;</button>
    <button class="carousel-control next">&gt;</button>
</div>
<section class="presentation">
    <div class="carousel-container">
        <div class="carousel-header">
            <h2 class="carrusel_title_product">Lo mas solicitado en jardineria</h2>
            <a href="#">Ir a Más vendidos</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product['variants'])) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product['variants']) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product['variants'][$randomIndex];
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
            <h2 class="carrusel_title_product">Más solicitados en electrodomesticos</h2>
            <a href="#">Ir a electrodomésticos</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product['variants'])) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product['variants']) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product['variants'][$randomIndex];
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
            <h2 class="carrusel_title_product">Esto podría interesarte</h2>
            <a href="#">Ver más</a>
        </div>

        <div class="carousel">
            <div class="carousel-track">
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i <= 15) {
                        if (!empty($product['variants'])) {
                            // Obtener un índice aleatorio dentro del rango válido
                            $randomIndex = rand(0, count($product['variants']) - 1);
                            // Obtener la variante aleatoria
                            $randomVariant = $product['variants'][$randomIndex];
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
</section>

<style>
    .presentation {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        margin: auto;
        width: 80%;
    }

    .presentation>.carousel-container {
        margin: 20px 0;

    }
</style>


<div class="product-banner">
    <div class="banner-left">
        <img src="/img/cards/ropa.jpg" alt="Lavadoras Greenwind" class="product-image-banner">
    </div>
    <div class="banner-right">
        <h4>LAVADO Y SECADO</h4>
        <h1>ENVÍOS A TODO EL PAÍS</h1>
        <a href="#" class="cta-button">VER MÁS</a>
    </div>
</div>