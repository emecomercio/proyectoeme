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
    <?php view("components/carousel") ?>
    <?php
    foreach ($products as $product) {
        view("components/product", ["product" => $product]);
    }
    ?>
    <?php view("components/categories") ?>
    <?php view('components/footer'); ?>

</body>

</html>