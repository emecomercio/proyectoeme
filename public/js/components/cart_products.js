document.addEventListener("DOMContentLoaded", function () {
  const cartProductsContainer = document.getElementById("cart-products");
  const purchaseSummaryContainer = document.getElementById("purchase-summary");

  // Recuperar el carrito desde localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  console.log("Carrito recuperado:", cart); // Verifica el contenido del carrito

  if (cart.length > 0) {
    cartProductsContainer.innerHTML = ""; // Limpiar el contenido inicial

    let totalAmount = 0;

    cart.forEach((product) => {
      console.log("Producto procesado:", product); // Verifica cada producto

      const price = parseFloat(product.price);
      const quantity = parseInt(product.quantity, 10);

      console.log("Precio:", price, "Cantidad:", quantity); // Verifica valores de price y quantity

      if (!isNaN(price) && !isNaN(quantity)) {
        let productDiv = document.createElement("div");
        productDiv.classList.add("cart-product");

        productDiv.innerHTML = `
                   <img class="product-img" src="https://emprendepyme.net/wp-content/uploads/2023/03/servicio-producto.jpg" alt="Descripción de la imagen" />
                    <h4>${product.name}</h4>
                    <p>Precio: $${price.toFixed(2)}</p>
                    <p>Cantidad: ${quantity}</p>
                    <p>Total: $${(price * quantity).toFixed(2)}</p>
                    <button class="button-delete">Eliminar</button>
                `;
        // Suponiendo que productDiv ya ha sido creado y contiene la imagen
        const productImg = productDiv.querySelector(".product-img");

        // Establecer el ancho y la altura de la imagen
        productImg.style.width = "80px"; // Ancho de 80 píxeles
        productImg.style.height = "80px"; // Altura de 80 píxeles
        productImg.style.objectFit = "cover"; // Asegura que la imagen mantenga su aspecto

        // Seleccionar el botón y aplicar estilo
        const deleteButton = productDiv.querySelector(".button-delete");
        deleteButton.style.backgroundColor = "#CC0000"; // Color de fondo rojo
        deleteButton.style.color = "white"; // Color del texto a blanco
        deleteButton.style.border = "none"; // Sin borde
        deleteButton.style.padding = "10px"; // Espaciado interno
        deleteButton.style.cursor = "pointer"; // Cambia el cursor a mano
        deleteButton.style.borderRadius = "5px"; // Esquinas redondeadas
        cartProductsContainer.appendChild(productDiv);

        totalAmount += price * quantity;
      } else {
        console.warn(`Producto con datos inválidos:`, product);
      }
    });

    purchaseSummaryContainer.innerHTML = `
            <h3>Resumen de compra</h3>
            <p>Total: $${totalAmount.toFixed(2)}</p>
            <a href="#"> <button class="button-cart">Comprar</button></a>
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
