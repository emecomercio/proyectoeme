<?php

/** @var array $product*/ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    loadCSS();
    loadCSS("pages/product-page");
    ?>
    <title><?= $product['name'] . ' ' ?> Page</title>
</head>

<body>
    <?php view("layout/top-header") ?>
    <main>
        <?php
        view("components/products/product", ["product" => $product]);
        ?>

        <?php view("components/products/reviews-questions", ["product" => $product]) ?>
        <?php view("components/products/reviews") ?>
    </main>
    <?php view("layout/footer") ?>
</body>
<?php
loadjs("components/user-button");
loadJS("components/buy-button");
loadJS("components/color-model-selector");
loadJS("components/thumbnails");
?>

</html>