<div class="product-description-container">
    <div class="product-image-container">
        <button class="favorite-button">♡</button>
        <img src="<?= $product['image_500x500']['image_url'] ?>" width="500" height="500" alt="Producto" class="product-image" />
    </div>
    <div class="product-details-container">
        <h2 class="product-name"><?= $product['name'] ?></h2>
        <p class="product-price"><?= $product['price'] ?></p>
        <ul class="product-info">
            <?= $product['description'] ?>
        </ul>
        <div class="model-color-selection">
            <label for="model" class="model-label">Modelo:</label>
            <select id="model" class="model-select">
                <option value="model1">Modelo 1</option>
                <option value="model2">Modelo 2</option>
            </select>
            <label for="color" class="color-label">Color:</label>
            <select id="color" class="color-select">
                <option value="red">Rojo</option>
                <option value="blue">Azul</option>
            </select>
        </div>
        <button class="buy-button">Comprar</button>
    </div>
</div>