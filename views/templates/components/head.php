<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/6.4.4/css/flag-icons.min.css">
    <link rel="stylesheet" href="<?= asset('/css/global.css') ?>">

    <?php if (isset($styles)) : ?>
        <?php foreach ($styles as  $style) : ?>
            <link rel="stylesheet" href="<?= asset($style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="https://unpkg.com/i18next/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
    <script type="module" src="<?= asset('/js/main.js') ?>"></script>
    <?php
    if (isset($scripts)) {
        foreach ($scripts as $script) {
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
    }
    ?>

    <title><?= isset($title) ? $title : "Default" . " | EME Comercio" ?></title>
</head>