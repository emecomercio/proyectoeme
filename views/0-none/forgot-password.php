<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Olvidaste tu contraseña?</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/forgot-password") ?>

<body>
    <main>
        <?php render('layout/top-header-nobar'); ?>
        <?php render('components/user-auth/forgot-password'); ?>
    </main>
    <?php render('layout/footer'); ?>
    <script type="module" src="<?= asset("/js/main.js") ?>"></script>
</body>

</html>