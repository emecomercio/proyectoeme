<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir producto</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/upload-product") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <?php view('components/enterprise-auth/upload-product'); ?>
    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    loadjs("components/preview-product");
    loadjs("components/dropdown-product");
    loadjs("components/upload-product-text");
    ?>
</body>

</html>