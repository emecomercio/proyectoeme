<a href="/product-page/<?= $product["variant_id"] ?>" class="product-card">
    <img
        src="<?= $product['images']['500x500']['url'] ?? "https://picsum.photos/200/300?random=168" ?>"
        width="500" height="500"
        alt="<?= "altext" ?>" />
    <div class="product-info">
        <h2 class="product-title"><?= $product['name'] ?></h2>
        <span class="product-price">$<?= $product['price'] ?? 2 ?></span>
        <p class="shipment">Envio gratis</p>
    </div>
</a>