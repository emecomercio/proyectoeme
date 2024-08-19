<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis favoritos</title>
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/favorites") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <?php view("components/users/favorite") ?>

    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    loadjs("components/favorite-button");
    ?>
</body>

</html>