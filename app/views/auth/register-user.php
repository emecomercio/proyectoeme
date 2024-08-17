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
    <style>
        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <?php view('layout/top-header-nobar'); ?>
    <main>
        <?php view('components/user-auth/register-form'); ?>
    </main>

    <?php view('layout/footer'); ?>
    <?php
    loadJS("components/user-button");
    loadJS("components/register-button");
    ?>

</body>

</html>