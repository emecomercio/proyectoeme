document.addEventListener('DOMContentLoaded', function() {
    const cartProductsContainer = document.getElementById('cart-products');
    const purchaseSummaryContainer = document.getElementById('purchase-summary');

    // Recuperar el carrito desde localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    console.log('Carrito recuperado:', cart);  // Verifica el contenido del carrito

    if (cart.length > 0) {
        cartProductsContainer.innerHTML = ''; // Limpiar el contenido inicial

        let totalAmount = 0;

        cart.forEach(product => {
            console.log('Producto procesado:', product);  // Verifica cada producto

            const price = parseFloat(product.price);
            const quantity = parseInt(product.quantity, 10);

            console.log('Precio:', price, 'Cantidad:', quantity);  // Verifica valores de price y quantity

            if (!isNaN(price) && !isNaN(quantity)) {
                let productDiv = document.createElement('div');
                productDiv.classList.add('cart-product');

                productDiv.innerHTML = `
                    <h4>${product.name}</h4>
                    <p>Precio: $${price.toFixed(2)}</p>
                    <p>Cantidad: ${quantity}</p>
                    <p>Total: $${(price * quantity).toFixed(2)}</p>
                `;

                cartProductsContainer.appendChild(productDiv);

                totalAmount += price * quantity;
            } else {
                console.warn(`Producto con datos inválidos:`, product);
            }
        });

        purchaseSummaryContainer.innerHTML = `
            <h3>Resumen de compra</h3>
            <p>Total: $${totalAmount.toFixed(2)}</p>
        `;
    } else {
        cartProductsContainer.innerHTML = `
            <img class="icon-cart" src="<?= loadIMG("icons/carrito_icono.png") ?>" alt="">
            <h3>¡Tu carrito está vacío!</h3>
            <p>Agrega productos para empezar a comprar.</p>
            <a href="/"> <button class="button-cart">Descubrir productos</button></a>
        `;
    }
});