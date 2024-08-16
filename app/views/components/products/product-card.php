<?php

/** @var array $product*/ ?>

<a href="/product-page/<?= $product["id"] ?>" class="product-card">
  <img
    src="<?= $product['image_500x500']['image_url'] ?>"
    width="500" height="500"
    alt="<?= $product['image_500x500']['alt_text'] ?>" />
  <div class="product-info">
    <h2 class="product-title"><?= $product['name'] ?></h2>
    <p class="product-description">
      Habria que ver que tipo de informacion vamos a poner aca para implementarlo en la BD
    </p>
    <span class="product-price"><?= $product['price'] ?></span>
    <p class="shipment">Envio gratis</p>
  </div>
</a>