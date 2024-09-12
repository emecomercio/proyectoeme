document.addEventListener('DOMContentLoaded', function() {
    const favoritesContainer = document.getElementById('favorites-products-container');

    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    console.log('Favoritos recuperados:', favorites); 

    if (favorites.length > 0) {
        favoritesContainer.innerHTML = ''; 

        favorites.forEach(favorites => {
            console.log('Producto en favoritos:', favorites)

            const price = parseFloat(product.price);

            if (!isNaN(price)) {
                favoritesContainer.innerHTML += `
                    <div class="favorite-product">
                        <img src="${product.image}" alt="${product.name}">
                        <h4>${product.name}</h4>
                        <p>Precio: $${price.toFixed(2)}</p>
                    </div>
                `;
            } else {
                console.warn(`Producto con datos inválidos:`, product);
            }
        });
    } else {
        favoritesContainer.innerHTML = `
            <img class="icon-cart" src="<?= loadIMG('icons/favorito-papel-corazon.png') ?>" alt="Carrito">
            <h3>¡Empieza una lista de favoritos!</h3>
            <p>Suma productos y consigue envío gratis.</p>
            <a href="/"><button class="button-cart">Descubrir productos</button></a>
        `;
    }
});
