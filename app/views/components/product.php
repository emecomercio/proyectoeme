<article class="product-card">
    <div class="product-image">
        <img src="<?= $product['image_url'] ?>" alt="Product IMG">
    </div>
    <div class="product-body">
        <h1 class="product-title"><?= $product['name'] ?></h1>
        <p class="product-description"><?= $product['description'] ?></p>
        <p class="product-price"><?= $product['price'] ?></p>
    </div>
</article>