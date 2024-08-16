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
    <?php view('components/top-header-nobar'); ?>
    <main>
        <?php view('components/login-entrepise-component'); ?>
        <?php view('components/footer'); ?>
    </main>
    <?php
    loadJS("user-button");
    ?>
</body>

</html>