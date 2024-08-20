<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Olvidaste tu contraseña?</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/forgot-password") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <?php view('components/user-auth/forgot-password'); ?>
    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    ?>
</body>

</html>