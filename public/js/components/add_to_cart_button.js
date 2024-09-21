// Esperar que el documento esté completamente cargado
document.addEventListener("DOMContentLoaded", () => {
  // Seleccionar el botón de añadir al carrito
  const addToCartButton = document.getElementById("add-to-cart-button");

  // Agregar un event listener al botón de añadir al carrito
  addToCartButton.addEventListener("click", function() {
      // Obtener los datos del producto del botón usando sus atributos data
      const productId = this.getAttribute("data-product-id");
      const productName = this.getAttribute("data-product-name");
      const productPrice = this.getAttribute("data-product-price");

      // Crear un objeto para representar el producto
      const product = {
          id: productId,
          name: productName,
          price: parseFloat(productPrice),
          quantity: 1 // Puedes ajustar la cantidad según lo que el usuario elija
      };

      // Obtener los productos almacenados en el carrito desde el localStorage
      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      // Verificar si el producto ya está en el carrito
      const existingProduct = cart.find(item => item.id === productId);

      if (existingProduct) {
          // Si el producto ya está en el carrito, incrementar su cantidad
          existingProduct.quantity++;
      } else {
          // Si el producto no está en el carrito, agregarlo
          cart.push(product);
      }

      // Guardar el carrito actualizado en el localStorage
      localStorage.setItem("cart", JSON.stringify(cart));
    console.log(cart);

      // Opcional: mostrar un mensaje de éxito
      alert("Producto añadido al carrito");
  });
});