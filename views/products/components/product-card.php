<script src="https://unpkg.com/i18next/i18next.min.js"></script>
<script src="https://unpkg.com/i18next-http-backend/i18nextHttpBackend.min.js"></script>
<?php

/**
 * @var App\Models\Product $parent
 * @var App\Models\Variant $product
 */
?>

<a href="/product-page/<?= $parent->id . "/" . $variantNumber ?>" class="product-card">
    <img
        src="<?= $product->images[0]->src ?? "https://picsum.photos/500?random=168" ?>"
        width="500" height="500"
        alt="<?= $product->images[0]->alt ?? "no alt text" ?>" />
    <div class="product-info">
        <h2 class="product-title"><?= $parent->name ?></h2>
        <span class="product-price">$<?= $product->current_price ?? 2 ?></span>
        <p class="shipment">Envio gratis</p>
    </div>
</a>