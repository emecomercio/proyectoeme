document.getElementById('add-to-cart-button').addEventListener('click', function() {
    // Extraigo los datos del producto desde los atributos data-*
    const button = this;
    const productId = button.getAttribute('data-product-id');
    const name = button.getAttribute('data-product-name');
    const price = parseFloat(button.getAttribute('data-product-price'));
    const quantity = parseInt(document.getElementById('quantity-select').value);

    // Llamo a la función para añadir al carrito
    addToCart(productId, name, price, quantity);
});

function addToCart(productId, name, price, quantity) {
    // Obtengo el carrito desde localStorage o lo inicializamos como un array vacío
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Busco si el producto ya está en el carrito
    let productIndex = cart.findIndex(item => item.id === productId);

    if (productIndex !== -1) {
        // Si el producto ya está en el carrito, aumentamos la cantidad
        cart[productIndex].quantity += quantity;
    } else {
        // Si el producto no está en el carrito, lo agregamos
        cart.push({ id: productId, name: name, price: price, quantity: quantity });
    }

    // Guardamos el carrito actualizado en localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    console.log('Producto añadido al carrito:', cart);
}

