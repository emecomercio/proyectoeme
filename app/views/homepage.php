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
    <?php view('layout/top-header'); ?>
    <?php view("components/feedback/alert") ?>
    <main>
        <?php view("components/products/categories") ?>
        <div class="product-grid">
            <?php foreach ($products as $product) {
                view("components/products/product-card", ["product" => $product]);
            }
            ?>
        </div>
        <div class="recommended-products-wrapper">
            <div class="recommended-products-container">
                <button class="scroll-button left">&lt;</button>
                <?php foreach ($products as $product) {
                    view('components/products/recommended', ["product" => $product]);
                }
                ?>
                <button class="scroll-button right">&gt;</button>
                <div></div>
            </div>
    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadJS("components/js-recommended");
    loadJS("components/categories");
    loadJS("components/searchbar");
    loadjs("components/user-button");
    loadJS("components/alert");
    ?>
</body>

</html>