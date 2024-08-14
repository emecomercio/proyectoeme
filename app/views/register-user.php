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
    <?php loadCSS("pages/homepage") ?>

    <title>Homepage</title>
</head>

<body>
    <?php view('components/top-header'); ?>
    <main>
        <?php view('components/register-user-component'); ?>
        <?php view('components/footer'); ?>
    </main>
    <?php
    loadJS("searchbar");
    loadjs("user-button");
    ?>

</body>

</html>