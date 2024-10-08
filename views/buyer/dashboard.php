<?php

/** @var array $user
 */
?>
<!DOCTYPE html>
<html lang="en">
<title>Mis datos</title>
<link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">

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
    <?php render('layout/top-header-nobar'); ?>
    <main>
        <div class="dashboard">
            <h1> <?php echo $user["username"] ?></h1>

            <?php render('components/users/dashboard', ["key" => "fullname", "value" => $user["fullname"]]); ?>
            <?php render('components/users/dashboard', ["key" => "email", "value" => $user["email"]]); ?>
            <?php render('components/users/dashboard', ["key" => "birthdate", "value" => $user["birthdate"]]); ?>
            <?php render('components/users/dashboard', ["key" => "username", "value" => $user["username"]]); ?>
        </div>


    </main>
    <?php render('layout/footer'); ?>
    <script type="module" src="<?= asset("/js/main.js") ?>"></script>
</body>

</html>