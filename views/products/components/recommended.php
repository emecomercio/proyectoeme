<?php

/** @var array $product*/
?>

<div class="product">
    <img src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>" alt="Producto 1" class="product-photo">
    <h3 class="product-name"><?= $product['name'] ?></h3>
</div>