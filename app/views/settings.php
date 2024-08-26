<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/settings") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <?php view("components/users/settings") ?>

    </main>
    <?php view('layout/footer'); ?>
    <?php
     loadjs("components/user-button");
     loadJS("components/show-hide");
    ?>
</body>

</html>