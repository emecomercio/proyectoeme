<?php

/** @var array $product*/ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    loadCSS();
    loadCSS("pages/cart");

    ?>
    <title><?= $product['name'] . ' ' ?> Page</title>
</head>

<body>
    <?php view("layout/top-header") ?>
    <main>
        <?php view("components/users/cart") ?>



    </main>
    <?php view("layout/footer") ?>
</body>
<?php
loadJS("searchbar");
loadjs("components/user-button");
loadJS("components/js-recommended");

?>

</html>