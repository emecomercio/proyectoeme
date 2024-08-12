<?php

/** @var array $product*/ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    loadCSS();
    loadCSS("pages/product-page-example");

    ?>
    <title><?= $product['name'] . ' ' ?> Page</title>
</head>

<body>
    <?php view("components/top-header") ?>
    <main>
        <?php
        view("components/product", ["product" => $product]);
        ?>
    </main>
    <?php view("components/footer") ?>
</body>

</html>