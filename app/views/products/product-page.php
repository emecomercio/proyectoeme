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
        <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">

    <title><?= $product['name'] ?></title>
</head>

<body>
    <?php view("layout/top-header") ?>
    <main>
        <?php
        view("components/products/product", ["product" => $product]);
        ?>

        <?php view("components/products/reviews-questions") ?>
        <div class="comments-container">
            <?php
            // Temporal
            for ($i = 0; $i < 10; $i++) {
                view("components/products/reviews", ["product" => $product]);
            }
            ?>
        </div>
    </main>
    <?php view("layout/footer") ?>
</body>
<?php
loadjs("components/favorite-button");
loadjs("components/user-button");
loadJS("components/buy-button");
loadJS("components/color-model-selector");
loadJS("components/thumbnails");
?>

</html>