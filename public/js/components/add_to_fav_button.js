document.querySelector('.favorite-button').addEventListener('click', function() {
    // Extraer datos del producto desde los atributos data-*
    const button = this;
    const productId = button.getAttribute('data-product-id-fav');
    const name = button.getAttribute('data-product-name-fav');
    const price = parseFloat(button.getAttribute('data-product-price-fav'));
    const image = button.getAttribute('data-product-image-fav');

    // Llamar a la función para añadir a favoritos
    addToFavorites(productId, name, price, image);
});

function addToFavorites(productId, name, price, image) {
    // Obtener la lista de favoritos desde localStorage o inicializar como un array vacío
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // Verificar si el producto ya está en la lista de favoritos
    let productIndex = favorites.findIndex(item => item.id === productId);

    if (productIndex === -1) {
        // Si el producto no está en favoritos lo agrega
        favorites.push({ id: productId, name: name, price: price, image: image });
        console.log('Producto añadido a favoritos:', { id: productId, name: name, price: price, image: image });
    } else {
        console.log('El producto ya está en favoritos');
    }

    // Guardar la lista de favoritos actualizada en localStorage
    localStorage.setItem('favorites', JSON.stringify(favorites));
    console.log('Producto añadido a los favoritos:', favorites);
}
