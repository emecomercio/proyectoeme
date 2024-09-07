<?php

/** @var array $products
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php loadCSS() ?>
    <?php loadCSS("pages/register-user") ?>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">

    <title>Registro de empresa</title>
</head>

<body>
    <?php render('layout/top-header-nobar'); ?>
    <main>
        <?php render("components/enterprise-auth/register-entreprise-component", ["errorMsg" => $errorMsg]) ?>

    </main>
    <?php render('layout/footer'); ?>
    <script type="module" src="<?= asset("/js/main.js") ?>"></script>
</body>

</html>