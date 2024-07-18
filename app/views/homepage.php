<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/pages/homepage.css">

    <title>Homepage</title>
</head>

<body>
    <?php view('components/header'); ?>
    <?php view("components/carousel") ?>
    <?php view("components/products") ?>
    <?php view("components/categories") ?>
    <?php view('components/footer'); ?>

</body>

</html>