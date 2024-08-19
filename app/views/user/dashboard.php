<?php

/** @var array $user
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    loadCSS();
    loadCSS("pages/user-dashboard");
    ?>

    <title>Homepage</title>
</head>

<body>
    <?php view('layout/top-header'); ?>
    <main>
        <ul>
            <?php foreach ($user as $key => $value) : ?>
                <li><?= "<strong>" . $key . "</strong>" ?>: <?= $value ?? '---' ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadJS("components/categories");
    loadJS("components/searchbar");
    loadjs("components/user-button");
    ?>
</body>

</html>