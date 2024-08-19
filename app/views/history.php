<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/history") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
        <h1>Historial</h1>

    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    ?>
</body>

</html>