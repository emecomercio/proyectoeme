document
  .getElementById("add-to-cart-button")
  .addEventListener("click", function () {
    // Extraigo los datos del producto desde los atributos data-*
    const button = this;
    const productId = button.getAttribute("data-product-id");
    const name = button.getAttribute("data-product-name");
    const price = parseFloat(button.getAttribute("data-product-price"));
    const quantity = parseInt(document.getElementById("quantity-select").value);

    // Llamo a la función para añadir al carrito
    addToCart(productId, name, price, quantity);
  });

function addToCart(productId, name, price, quantity) {
  // Obtengo el carrito desde localStorage o lo inicializamos como un array vacío
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Busco si el producto ya está en el carrito
  let productIndex = cart.findIndex((item) => item.id === productId);

  if (productIndex !== -1) {
    // Si el producto ya está en el carrito, aumentamos la cantidad
    cart[productIndex].quantity += quantity;
  } else {
    // Si el producto no está en el carrito, lo agregamos
    cart.push({ id: productId, name: name, price: price, quantity: quantity });
  }

  // Guardamos el carrito actualizado en localStorage
  localStorage.setItem("cart", JSON.stringify(cart));

  console.log("Producto añadido al carrito:", cart);
}

// esta funcion es del dropdown de la cantidad
const quantityToggle = document.getElementById("quantity-toggle");
const quantityContainer = document.querySelector(".quantity-container");
const selectedQuantity = document.getElementById("selected-quantity");
const quantityOptions = document.querySelectorAll(".quantity-option");

// Toggle el dropdown al hacer clic en la etiqueta de cantidad
quantityToggle.addEventListener("click", function () {
  quantityContainer.classList.toggle("active");
});

// Actualiza la cantidad seleccionada al hacer clic en una opción
quantityOptions.forEach((option) => {
  option.addEventListener("click", function () {
    selectedQuantity.textContent = this.textContent;
    quantityContainer.classList.remove("active");
  });
});

// Cierra el dropdown si se hace clic fuera del contenedor
document.addEventListener("click", function (event) {
  if (!quantityContainer.contains(event.target)) {
    quantityContainer.classList.remove("active");
  }
});

// este codigo corresponde a el cambio de imagenes
// Seleccionamos la imagen principal y las miniaturas
const mainImage = document.getElementById("main-product-image");
const thumbnails = document.querySelectorAll(".thumbnail");

// Función para intercambiar la imagen principal con la miniatura clicada
thumbnails.forEach((thumbnail) => {
  thumbnail.addEventListener("click", function () {
    // Guardamos la fuente y el alt de la imagen principal
    const mainSrc = mainImage.src;
    const mainAlt = mainImage.alt;

    // Cambiamos la imagen principal por la miniatura
    mainImage.src = this.src;
    mainImage.alt = this.alt;

    // Cambiamos la miniatura clicada por la antigua imagen principal
    this.src = mainSrc;
    this.alt = mainAlt;
  });
});

function handleButtonClick(buttonId, contentId) {
  // Ocultamos la sección "recent-questions"
  const recentQuestions = document.querySelector(".recent-questions");
  recentQuestions.style.display = "none";

  // Ocultamos todas las secciones de contenido
  const contentSections = document.querySelectorAll(".content-section");
  contentSections.forEach((section) => {
    section.style.display = "none";
  });

  // Mostramos la sección correspondiente al botón clicado
  const contentToShow = document.getElementById(contentId);
  contentToShow.style.display = "block";
}

// Asignamos los eventos de clic a cada botón
document.getElementById("costo").addEventListener("click", function () {
  handleButtonClick("costo", "costo-content");
});

document.getElementById("devoluciones").addEventListener("click", function () {
  handleButtonClick("devoluciones", "devoluciones-content");
});

document.getElementById("metodos").addEventListener("click", function () {
  handleButtonClick("metodos", "metodos-content");
});

document.getElementById("garantia").addEventListener("click", function () {
  handleButtonClick("garantia", "garantia-content");
});
