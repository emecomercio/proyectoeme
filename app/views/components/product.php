<!-- <article class="product-card">
    <div class="product-image">
        <img src="<?= $product['image_url'] ?>" alt="Product IMG">
    </div>
    <div class="product-body">
        <h1 class="product-title"><?= $product['name'] ?></h1>
        <p class="product-description"><?= $product['description'] ?></p>
        <p class="product-price"><?= $product['price'] ?></p>
    </div>
</article> -->


<!DOCTYPE html>
<html lang="es">
<body>
    <div class="product-description-container">
        <div class="product-image-container">
            <button class="favorite-button">♡</button>
            <img src="#" alt="Producto" class="product-image" />
        </div>
        <div class="product-details-container">
            <h2 class="product-name">Nombre del Producto</h2>
            <p class="product-price">$99.99</p>
            <ul class="product-info">
                <li>- Este producto es de alta calidad y durabilidad</li>
                <li>- Viene con una garantía de 2 años.</li>
                <li>- Es de una olla y una batidora, perfectas para tu cocina</li>
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
</body>
</html>
