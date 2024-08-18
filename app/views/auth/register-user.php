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

    <title>Pagina de Registro</title>
    <style>
        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <?php view('layout/top-header-nobar'); ?>
    <main>
        <?php view('components/user-auth/register-form', ['errorMsg' => $errorMsg]); ?>
    </main>

    <?php view('layout/footer'); ?>
    <?php

    loadJS("components/auth/password_validation");
    loadJS("components/user-button");
    ?>

</body>

</html>