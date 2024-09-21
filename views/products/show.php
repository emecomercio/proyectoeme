<?php

/** @var array $products
 */
// ESTABA TOMANDO EL VARIANT PARA MOSTRARLO POR DEFAULT
?>

<div class="product-page">
    <!-- Imagen principal del producto -->
    <div class="product-page__main">

        <!-- Limitar a 10 imagenes-->
        <div class="thumbnail-container">
            <?php foreach ($product['variants'][$variantNumber]['images']['500x500'] as $thumbnail) : ?>
                <img src="<?= $thumbnail['src'] ?>" alt="<?= $thumbnail['alt'] ?? 'no altern text' ?>" class="thumbnail">
            <?php endforeach; ?>
        </div>

        <div class="product-page__images1">

            <img

                src="<?= $product['variants'][$variantNumber]['images']['500x500'][0]['src'] ?>"
                width="500"
                height="500"
                alt="<?= $product['variants'][$variantNumber]['images']['500x500'][0]['alt'] ?? 'no altern text' ?>"
                id="main-product-image" />
            <button class="favorite-button">♡</button>
        </div>

    </div>

    <!-- Información del producto -->
    <div class="product-page__info">

        <h1 class="product-page__title">
            <?= $product['name'] ?>
        </h1>
        <p class="product-page__price">
            $<?= $product['variants'][0]['current_price'] ?>
        </p>
        <p class="product-page__payment-options">
            En hasta 12 cuotas de $70 sin interés
        </p>
        <p class="product-page__availability">Última disponible</p>
        <div class="quantity-container">
            <span class="quantity-label" id="quantity-toggle">Cantidad: <span id="selected-quantity">1 unidad</span>
                <span class="quantity-arrow">^</span></span>
            <ul class="quantity-dropdown">
                <li class="quantity-option" data-value="1">1 unidad</li>
                <li class="quantity-option" data-value="2">2 unidades</li>
                <li class="quantity-option" data-value="3">3 unidades</li>
                <li class="quantity-option" data-value="4">4 unidades</li>
                <li class="quantity-option" data-value="5">5 unidades</li>
                <li class="quantity-option" data-value="6">6 unidades</li>
            </ul>
        </div>
        <p class="quantity-availability">(+10 disponibles)</p>
        <div class="product-options">
            <div class="option">
                <p>Seleccione: <strong>Modelo:</strong></p>
                <div class="choices">
                    <div class="choice" data-choice="256 GB">Modelo 1</div>
                    <div class="choice" data-choice="512 GB">Modelo 2</div>
                </div>
            </div>

            <div class="option">
                <p>Seleccione: <strong>Talle</strong></p>
                <div class="choices">
                    <div class="choice" data-choice="8 GB">M</div>
                    <div class="choice" data-choice="12 GB">S</div>
                </div>
            </div>

            <div class="option">
                <p>Color: </p>
                <div class="color-choices">
                    <div class="color-choice" data-choice="Peacock blue">
                        <img src="#" alt="Peacock blue">
                    </div>
                    <div class="color-choice" data-choice="Golden">
                        <img src="#" alt="Golden">
                    </div>
                </div>
            </div>
        </div>


        <!-- Area to display the information -->
        <div id="product-info"></div>

        <div class="product-button">
            <button class="product-page__buy-button">Comprar ahora</button>
            <button class="product-page__buy-button" id="add-to-cart-button"
                data-product-id=<?= $product['id'] ?>
                data-product-name=<?= $product['name'] ?>
                data-product-price=<?= $product['variants'][0]['current_price'] ?>>
                Añadir al carrito
            </button>
            <p>
                Vendido por <a class="seller-name" href="/">Nombre del vendedor</a>
            </p>
        </div>
    </div>

    <!-- Características del producto -->
    <section class="product-page__features">
        <section class="product-features">
            <h1>Características del producto</h1>
            <div class="product-features__highlights">
                <div class="product-features__highlight">
                    <span class="icon">&#10003;</span>
                    <p>Temporada de lanzamiento: <strong>Otoño/Invierno</strong></p>
                </div>
                <div class="product-features__highlight">
                    <span class="icon">&#128204;</span>
                    <p>Marca: <strong>Genérica</strong></p>
                </div>
            </div>

            <div class="product-features__details">
                <!-- Características principales -->
                <div class="product-features__column">
                    <h2>Características principales</h2>
                    <table class="product-features__table">
                        <tr>
                            <td><strong>Marca</strong></td>
                            <td>Genérica</td>
                        </tr>
                        <tr>
                            <td><strong>Modelo</strong></td>
                            <td>Táctica</td>
                        </tr>
                        <tr>
                            <td><strong>Edad</strong></td>
                            <td>Adultos</td>
                        </tr>
                    </table>
                </div>

                <!-- Otras características -->
                <div class="product-features__column">
                    <h2>Otras características</h2>
                    <table class="product-features__table">
                        <tr>
                            <td><strong>Género</strong></td>
                            <td>Sin género</td>
                        </tr>
                        <tr>
                            <td><strong>Tipo de sombrero</strong></td>
                            <td>Paseamontañas</td>
                        </tr>
                        <tr>
                            <td><strong>Temporada de lanzamiento</strong></td>
                            <td>Otoño/Invierno</td>
                        </tr>
                        <tr>
                            <td><strong>Año de lanzamiento</strong></td>
                            <td>2022</td>
                        </tr>
                        <tr>
                            <td><strong>Con cierre ajustable</strong></td>
                            <td>No</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </section>

    <!-- Descripción del producto -->
    <section class="product-description">
        <?= $product['description'] ?>

        <div class="shop-info">
            <p><strong>***Somos Ganga Shop***</strong></p>
            <p>Contamos con local físico establecido en zona Centro.</p>
            <p>
                Nuestro horario es de lunes a viernes de 10:00 a 19:00hs y los
                sábados de 10:00 a 13:00hs.
            </p>
            <p class="highlight">
                Antes de comprar, realiza todas las consultas que desees y recuerda
                brindar toda la información necesaria para gestionar tu compra con
                éxito.
            </p>
            <p>
                Hacemos envíos a todo el país a través de
                <strong>Mercado Envíos</strong> y <strong>DAC</strong>.
            </p>
            <p>
                Para envío por DAC, seleccionar retiro en domicilio del vendedor y
                proporcionar los datos de quien recibe a través del chat de la
                compra.
            </p>
        </div>
    </section>
    <!-- preguntas y respuestas -->
    <div class="qa-section">
        <h2>Preguntas y respuestas</h2>

        <div class="questions-options">
            <button id="costo">Costo y tiempo de envío</button>
            <button id="devoluciones">Devoluciones gratis</button>
            <button id="metodos">Medios de pago y promociones</button>
            <button id="garantia">Garantía</button>
        </div>
        <div class="ask-question">
            <label for="question">Pregúntale al vendedor</label>
            <input
                type="text"
                id="question"
                placeholder="Escribe tu pregunta..." />
            <button class="ask-btn">Preguntar</button>
        </div>
        <div id="costo-content" class="content-section" style="display: none;">
            <h3>Costo y tiempo de envío</h3>
            <p>El costo y tiempo de envío varían según la ubicación y el método de envío seleccionado.
                Ofrecemos varias opciones de envío para que elijas la que mejor se adapte a tus necesidades:
                envío estándar, que tarda entre 3 y 5 días hábiles, y envío express, que tarda entre 1 y 2 días
                hábiles, dependiendo de la disponibilidad en tu zona. Además, los costos de envío se calculan en
                función del peso y el tamaño del paquete, así como de la distancia hasta la dirección de entrega.</p>
            <p>Para más detalles sobre el costo de envío, puedes ingresar tu código postal durante el proceso
                de compra y el sistema te mostrará todas las opciones disponibles y sus respectivos costos.</p>
        </div>

        <div id="devoluciones-content" class="content-section" style="display: none;">
            <h3>Devoluciones gratis</h3>
            <p>Nuestra política de devoluciones te permite devolver productos sin costo alguno en un plazo de
                30 días después de la compra. Si por alguna razón no estás satisfecho con tu compra, puedes iniciar
                el proceso de devolución fácilmente desde tu cuenta. Simplemente selecciona el producto que deseas
                devolver, elige el motivo y nosotros nos encargamos del resto.</p>
            <p>Es importante que el producto esté en perfectas condiciones y en su empaque original. Los reembolsos
                se procesan dentro de los 5 a 7 días hábiles después de recibir el producto devuelto. Si tienes alguna
                duda sobre el proceso de devolución, nuestro equipo de atención al cliente está disponible para ayudarte.</p>
        </div>

        <div id="metodos-content" class="content-section" style="display: none;">
            <h3>Medios de pago y promociones</h3>
            <p>Ofrecemos una amplia variedad de medios de pago para que puedas realizar tus compras de la manera
                más conveniente para ti. Puedes pagar con tarjetas de crédito y débito (Visa, Mastercard, American Express),
                transferencias bancarias, y plataformas de pago en línea como PayPal. También aceptamos pagos contra
                entrega en algunas ubicaciones.</p>
            <p>Además, regularmente lanzamos promociones exclusivas, como descuentos por pagar con ciertas tarjetas,
                pagos sin interés a meses, y cupones de descuento para que puedas ahorrar aún más. Te recomendamos estar
                atento a nuestras promociones vigentes, que suelen aparecer destacadas en la página de inicio o en la
                sección de ofertas.</p>
        </div>

        <div id="garantia-content" class="content-section" style="display: none;">
            <h3>Garantía</h3>
            <p>Todos nuestros productos cuentan con garantía de calidad. La duración de la garantía depende del tipo
                de producto, pero por lo general, ofrecemos una garantía de al menos 12 meses desde la fecha de compra.
                Esta garantía cubre cualquier defecto de fabricación o materiales defectuosos, siempre y cuando el producto
                haya sido utilizado bajo condiciones normales.</p>
            <p>En caso de que necesites hacer uso de la garantía, simplemente contáctanos con los detalles de la compra
                y el problema que has encontrado. Nuestro equipo de soporte técnico revisará el caso y, de ser necesario,
                reemplazaremos el producto o procederemos a una reparación gratuita.</p>
        </div>



        <div class="recent-questions">
            <h3>Últimas realizadas</h3>
            <p>¿Puede enviar por DAC?</p>
            <span>Hola, sí enviamos a todo el país. Saludos, Somos Ganga Shop.
                03/09/2024</span>
        </div>
    </div>

    <div class="reviews-section">
        <h2>Opiniones del producto</h2>

        <div class="review-summary">
            <span class="rating">4.8</span>
            <span class="total-reviews">17 calificaciones</span>
            <p>Al 100% le quedó como esperaba</p>
            <ul class="review-characteristics">
                <li>Relación precio/calidad: ★★★★★</li>
                <li>Calidad de los materiales: ★★★★★</li>
                <li>Comodidad: ★★★★★</li>
            </ul>
        </div>

        <div class="photo-review">
            <h3>Opiniones con fotos</h3>
            <img src="<?= $product['variants'][0]['images']['500x500'][0]['src'] ?>" alt="Foto del producto" />
        </div>

        <div class="sort-reviews">
            <button>Ordenar</button>
            <button>Calificación</button>
        </div>

        <div class="highlighted-reviews">
            <h3>Opiniones destacadas</h3>
            <div class="review">
                <p>
                    Muy cómodo y suave, excelente para realizar actividades
                    deportivas.
                </p>
                <span class="review-date">01 Ago 2024</span>
            </div>
            <div class="review">
                <p>Relación precio y calidad.</p>
                <span class="review-date">01 Ago 2024</span>
            </div>
        </div>

        <div class="show-more-reviews">
            <button>Mostrar todas las opiniones</button>
        </div>
    </div>
</div>
<div class="comments-container">


</div>