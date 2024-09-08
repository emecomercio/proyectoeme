<?php

/** @var array $product*/
?>

<div class="product-description-container">
    <div class="product-image-container">
        <button class="favorite-button">♡</button>
        <img src="<?= $product['variants'][0]['images']['500x500'][0]['src'] ?>" width="500" height="500" alt="<?= $product['variants'][0]['images']['500x500'][0]['alt'] ?? 'no altern text' ?>" class="product-image" id="main-product-image" />

        <!-- Thumbnails -->
        <div class="thumbnails">
            <img src="<?= $randomVariant['images']['500x500'][rand(0, (count($randomVariant['images']['500x500']) - 1))]['src'] ?>" alt="Thumbnail 1" class="thumbnail-image">
            <img src="<?= $randomVariant['images']['500x500'][rand(0, count($randomVariant['images']['500x500']) - 1)]['src'] ?>" alt="Thumbnail 2" class="thumbnail-image">
            <img src="<?= $randomVariant['images']['500x500'][rand(0, count($randomVariant['images']['500x500']) - 1)]['src'] ?>" alt="Thumbnail 3" class="thumbnail-image">
        </div>
    </div>
    <div class="product-details-container">
        <h2 class="product-name"><?= $product['name'] ?></h2>
        <p class="product-price">$<?= $product['variants'][0]['current_price'] ?></p>
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
            <button class="buy-button" id="add-to-cart-button"
                data-product-id=<?= $product['id'] ?>
                data-product-name=<?= $product['name'] ?>
                data-product-price=<?= $product['variants'][0]['current_price'] ?>>
                Añadir al carrito
            </button>
        </div>
    </div>
</div>
<div class="last_and_questions">
    <div id="frequent-questions-container">
        <h2 class="frequent-questions-title">Preguntas Frecuentes</h2>
        <div class="frequent-questions-item">
            <h3 class="frequent-questions-question">
                ¿Cuál es el tiempo de envío?
            </h3>
            <p class="frequent-questions-answer">
                El tiempo de envío es de 3 a 5 días hábiles.
            </p>
        </div>
        <div class="frequent-questions-item">
            <h3 class="frequent-questions-question">
                ¿Puedo devolver el producto?
            </h3>
            <p class="frequent-questions-answer">
                Sí, puedes devolver el producto dentro de los 30 días posteriores a
                la compra.
            </p>
        </div>
        <div class="frequent-questions-item">
            <h3 class="frequent-questions-question">
                ¿El producto tiene garantía?
            </h3>
            <p class="frequent-questions-answer">
                Sí, el producto tiene una garantía de un año.
            </p>
        </div>
        <div class="frequent-questions-item">
            <h3 class="frequent-questions-question">
                ¿Cómo puedo contactar al servicio al cliente?
            </h3>
            <p class="frequent-questions-answer">
                Puedes contactar al servicio al cliente a través de nuestro
                formulario de contacto o llamando al número de teléfono que se
                encuentra en nuestra página web.
            </p>
        </div>
    </div>
    <div class="product-interest">
        <h2>Productos de interes</h2>
        <div>
            <img src="https://cdn-imgix.headout.com/media/images/c9db3cea62133b6a6bb70597326b4a34-388-dubai-img-worlds-of-adventure-tickets-01.jpg?auto=format&w=814.9333333333333&h=458.4&q=90&ar=16%3A9&crop=faces" alt="">
        </div>
        <div>
            <img src="https://cdn-imgix.headout.com/media/images/c9db3cea62133b6a6bb70597326b4a34-388-dubai-img-worlds-of-adventure-tickets-01.jpg?auto=format&w=814.9333333333333&h=458.4&q=90&ar=16%3A9&crop=faces" alt="">
        </div>
        <div>
            <img src="https://cdn-imgix.headout.com/media/images/c9db3cea62133b6a6bb70597326b4a34-388-dubai-img-worlds-of-adventure-tickets-01.jpg?auto=format&w=814.9333333333333&h=458.4&q=90&ar=16%3A9&crop=faces" alt="">
        </div>
        <div>
            <img src="https://cdn-imgix.headout.com/media/images/c9db3cea62133b6a6bb70597326b4a34-388-dubai-img-worlds-of-adventure-tickets-01.jpg?auto=format&w=814.9333333333333&h=458.4&q=90&ar=16%3A9&crop=faces" alt="">
        </div>

    </div>

</div>
<div class="comments-container">
    <?php
    // Temporal
    for ($i = 0; $i < 10; $i++) {
        render("products/components/review", ["product" => $product]);
    }
    ?>
</div>