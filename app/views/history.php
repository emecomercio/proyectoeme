<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/history") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <?php view('components/users/history'); ?>

    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    loadJS("components/show-hide");
    ?>
</body>

</html>