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

    <title>Homepage</title>
</head>

<body>
    <?php view('layout/top-header-nobar'); ?>
    <main>
        <?php view('components/user-auth/login-user-component'); ?>
    </main>

    <?php view('layout/footer'); ?>
    <?php
    loadJS("components/searchbar");
    loadjs("components/user-button");

    ?>
</body>

</html>