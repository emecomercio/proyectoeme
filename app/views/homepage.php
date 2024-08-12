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
    <?php view('components/header'); ?>
    <?php view("components/categories") ?>
    <div class="product-grid">
        <?php foreach ($products as $product) {
            view("componets/card-product", ["product" => $product]);
        }
        ?>
    </div>
    <?php view('components/recommended'); ?>
    <?php view('components/footer'); ?>
</body>

</html>