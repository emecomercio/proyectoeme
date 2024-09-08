<?php

/** @var array $products
 */
?>
<?php render("feedback/alert") ?>
<?php render("feedback/alert-cookie") ?>
<section class="section-categories">
    <?php
    foreach ($catalogs as $catalog) {
        render("products/components/catalog", ["catalog" => $catalog]);
    }
    ?>
</section>
<div class="product-grid">
    <?php
    $i = 0;
    foreach ($products as $product) {
        if ($i <= 30) {
            if (!empty($product['variants'])) {
                // Obtener un índice aleatorio dentro del rango válido
                $randomIndex = rand(0, count($product['variants']) - 1);
                // Obtener la variante aleatoria
                $randomVariant = $product['variants'][$randomIndex];
                // Renderizar la variante aleatoria
                render("products/components/product-card", ["product" => $randomVariant]);
            }
            $i++;
        } else {
            break;
        }
    }
    ?>
</div>
<?php render("products/components/product-container-cards") ?>
<div class="recommended-products-wrapper">
    <h1>Recomendados</h1>
    <div class="recommended-products-container">
        <button class="scroll-button left">&lt;</button>
        <?php foreach ($products as $product) {
            render('products/components/recommended', ["product" => $product]);
        }
        ?>
        <button class="scroll-button right">&gt;</button>
        <div></div>
    </div>
</div>