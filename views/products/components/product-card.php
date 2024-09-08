<a href="/product-page/<?= $product["product_id"] ?>" class="product-card">
    <img
        src="<?= $product['images']['500x500']['src'][0] ?? "https://picsum.photos/200/300?random=168" ?>"
        width="500" height="500"
        alt="<?= $product['images']['500x500']['alt'] ?? "no alt text" ?>" />
    <div class="product-info">
        <h2 class="product-title"><?= $product['name'] ?></h2>
        <span class="product-price">$<?= $product['current_price'] ?? 2 ?></span>
        <p class="shipment">Envio gratis</p>
    </div>
</a>