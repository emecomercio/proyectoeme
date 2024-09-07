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
        <?php render('layout/top-header-nobar'); ?>
        <?php render("components/users/settings") ?>

    </main>
    <?php render('layout/footer'); ?>
    <script type="module" src="<?= asset("/js/main.js") ?>"></script>
</body>

</html>