<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <?php
    // recorrer meta tags
    ?>
    <?php
    loadCSS();
    loadCSS('components/categories');
    loadCSS('components/top-header');
    loadCSS('components/footer');
    ?>
    <?php
    foreach ($this->styles as $style) {
        loadCSS($style);
    }
    ?>
    <script type="module" src="<?= asset('/js/main.js') ?>"></script>
    <script type="module" src="<?= asset('/js/components/categories.js') ?>"></script>
    <?php
    foreach ($this->scripts as $script) {
        echo "<script";

        // Verifica si el tipo de script está definido
        if (!empty($script['type'])) {
            echo " type='{$script['type']}'";
        }

        // Agrega el atributo src
        echo " src='" . asset($script['src']) . "'";

        // Verifica si el atributo 'defer' está presente y es verdadero
        if (!empty($script['defer'])) {
            echo " defer";
        }

        // Cierra la etiqueta de script
        echo "></script>";
    }
    ?>

    <title><?= $title ?></title>
</head>

<body>
    <?= render('layout/header') ?>

    <main>
        <?= $content ?>
    </main>

    <?= render('layout/footer') ?>
</body>

</html>