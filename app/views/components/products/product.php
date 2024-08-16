<div class="product-description-container">
    <div class="product-image-container">
        <button class="favorite-button">♡</button>
        <img src="<?= $product['image_500x500']['image_url'] ?>" width="500" height="500" alt="Producto" class="product-image" id="main-product-image" />

        <!-- Thumbnails -->
        <div class="thumbnails">
            <img src="<?= $product['image_500x500']['image_url'] ?>" alt="Thumbnail 1" class="thumbnail-image">
            <img src="<?= $product['image_500x500']['image_url'] ?>" alt="Thumbnail 2" class="thumbnail-image">
            <img src="<?= $product['image_500x500']['image_url'] ?>" alt="Thumbnail 3" class="thumbnail-image">
        </div>
    </div>
    <div class="product-details-container">
        <h2 class="product-name"><?= $product['name'] ?></h2>
        <p class="product-price"><?= $product['price'] ?></p>
        <ul class="product-info">
            <?= $product['description'] ?>
        </ul>
        <div class="model-color-selection">
            <div class="model-selection">
                <label class="model-label">Modelo</label>
                <div class="models">
                    <div class="model" data-model="model1">Modelo 1</div>
                    <div class="model" data-model="model2">Modelo 2</div>
                    <div class="model" data-model="model3">Modelo 3</div>
                </div>
            </div>
            <div class="color-selection">
                <label class="color-label">Color</label>
                <div class="colors">
                    <div class="color red" data-color="red"></div>
                    <div class="color blue" data-color="blue"></div>
                    <div class="color yellow" data-color="yellow"></div>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="buy-button">Comprar</button>
            <button class="buy-button">Añadir al carrito</button>
        </div>
    </div>
</div>