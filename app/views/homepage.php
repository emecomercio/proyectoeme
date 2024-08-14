<?php

/** @var array $products
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php loadCSS() ?>
    <?php loadCSS("pages/homepage") ?>

    <title>Homepage</title>
</head>

<body>
    <?php view('components/top-header'); ?>
    <main>
        <?php view("components/categories") ?>
        <div class="product-grid">
            <?php foreach ($products as $product) {
                view("components/card-product", ["product" => $product]);
            }
            ?>
        </div>
        <div class="recommended-products-wrapper">
            <button class="scroll-button left">&lt;</button>
            <?php foreach ($products as $product) {
                view('components/recommended', ["product" => $product]);
            }
            ?>
            <button class="scroll-button right">&gt;</button>
        </div>
        <?php view('components/footer'); ?>
    </main>
    <?php
    loadJS("js-recommended");
    loadJS("categories");
    loadJS("searchbar");
    loadjs("user-button");
    ?>
</body>

</html>