<div class="product-description-container">
    <div class="product-image-container">
        <button class="favorite-button">♡</button>
        <img src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>" width="500" height="500" alt="Producto" class="product-image" id="main-product-image" />

        <!-- Thumbnails -->
        <div class="thumbnails">
            <img src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>" alt="Thumbnail 1" class="thumbnail-image">
            <img src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>" alt="Thumbnail 2" class="thumbnail-image">
            <img src="<?= $product['image_500x500']['image_url'] ?? "https://picsum.photos/200/300?random=168" ?>" alt="Thumbnail 3" class="thumbnail-image">
        </div>
    </div>
    <div class="product-details-container">
        <h2 class="product-name"><?= $product['name'] ?></h2>
        <p class="product-price"><?= $product['price'] ?? 2 ?></p>
        <ul class="product-info">
            <?= $product['description'] ?>
        </ul>
        <div class="selectors">
            <div class="model-selection">
                <label class="model-label" for="model-select">Modelo</label>
                <select id="model-select" class="model-select">
                    <option value="model1">Modelo 1</option>
                    <option value="model2">Modelo 2</option>
                    <option value="model3">Modelo 3</option>
                </select>
            </div>

            <div class="color-selection">
                <label class="color-label">Color</label>
                <div class="colors">
                    <div class="color red" data-color="red"></div>
                    <div class="color blue" data-color="blue"></div>
                    <div class="color yellow" data-color="yellow"></div>
                </div>
            </div>
            <div class="quantity-dropdown">
                <label for="quantity-select">Seleccionar cantidad</label>
                <div class="custom-select">
                    <select id="quantity-select" class="quantity-select">
                        <option value="1">1 unidad</option>
                        <option value="2">2 unidades</option>
                        <option value="3">3 unidades</option>
                        <option value="4">4 unidades</option>
                        <option value="5">5 unidades</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="button-container">
            <button class="buy-button">Comprar</button>
            <button class="buy-button">Añadir al carrito</button>
        </div>
    </div>
</div>