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
    <?php view('layout/top-header-nobar'); ?>
    <main>
        <?php view("components/enterprise-auth/register-entreprise-component", ["errorMsg" => $errorMsg]) ?>

    </main>
    <?php view('layout/footer'); ?>
    <?php

    loadJS("components/auth/password_validation");
    loadJS("components/user-button");
    ?>
</body>

</html>