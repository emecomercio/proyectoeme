<h1>TU CARRITO</h1>
<div class="cart-component-container">
    <div class="cart-container">
        <h3 class="h3">Tus productos agregados al carrito</h3>
        <div class="cart-container-content" id="cart-products">
            <img class="icon-cart" src="<?= asset("/img/icons/carrito_icono.png") ?>" alt="">
            <h3>¡Tu carrito está vacío!</h3>
            <p>Agrega productos para empezar a comprar.</p>
            <a href="/"> <button class="button-cart">Descubrir productos</button></a>
        </div>
    </div>
    <div class="purchase-summary" id="purchase-summary">
        <h3>Resumen de compra</h3>
        <p>Aquí verás los importes de tu compra una vez que agregues productos.</p>
    </div>
</div>
<div class="payment-options">
    <div class="option">
        <h4 class="option-title">¡Cuotas sin interés!</h4>
        <div class="icons">
            <a href="#"><img src="https://via.placeholder.com/50x30?text=VISA" alt="VISA"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=MasterCard" alt="MasterCard"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=Diners" alt="Diners Club"></a>
        </div>
        <p class="option-description">12 cuotas</p>
    </div>

    <div class="option">
        <h4 class="option-title">Tarjetas internacionales a través de PayPal</h4>
        <p class="option-description">1 pago sin interés</p>
        <div class="icons">
            <a href="#"><img src="https://via.placeholder.com/50x30?text=PayPal" alt="PayPal"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=VISA" alt="VISA"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=MasterCard" alt="MasterCard"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=Amex" alt="Amex"></a>
        </div>
    </div>

    <div class="option">
        <h4 class="option-title">Tarjeta Prex prepaga internacional</h4>
        <p class="option-description">Recarga en:</p>
        <div class="icons">
            <a href="#"><img src="https://via.placeholder.com/50x30?text=Prex" alt="Prex"></a>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=Abitab" alt="Abitab"></a>
        </div>
    </div>
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Medios de pago</h2>
            <p>Tarjetas prepagas, débito, y crédito hasta en 12 cuotas sin interés en pesos Uruguayos</p>
            <p>Pagá hasta en 12 cuotas sin interés en pesos uruguayos durante este mes</p>
            <div class="modal-icons">
                <a href="#"><img src="https://via.placeholder.com/50x30?text=VISA" alt="VISA"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=MasterCard" alt="MasterCard"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=OCA" alt="OCA"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Amex" alt="American Express"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Midinero" alt="Midinero"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Lider" alt="Lider"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Diners" alt="Diners Club"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Prex" alt="Prex"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=Abitab" alt="Abitab"></a>
                <a href="#"><img src="https://via.placeholder.com/50x30?text=OCA+Blue" alt="OCA Blue"></a>
            </div>
            <h3>Pagos a través de PayPal</h3>
            <a href="#"><img src="https://via.placeholder.com/50x30?text=PayPal" alt="PayPal"></a>
        </div>
    </div>
</div>