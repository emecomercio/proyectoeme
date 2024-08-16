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
    <?php view("components/top-header") ?>
    <main>




    </main>
    <?php view("components/footer") ?>
</body>
<?php
loadJS("searchbar");
loadjs("user-button");

?>

</html>