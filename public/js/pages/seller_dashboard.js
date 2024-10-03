const createProduct = (data) => {
  fetch(`/api/seller/${data["seller-id"]}/products`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Error al crear el producto');
      }
      return response.json();
    })
    .then((responseData) => {
      console.log(responseData);
      // Después de crear el producto, vuelve a cargar la lista de productos
      getProductsBySeller(data["seller-id"]);
    })
    .catch((error) => {
      console.error('Error:', error);
      alert("Hubo un problema al crear el producto.");
    });
};

const getProductsBySeller = (sellerId) => {
  fetch(`/api/seller/${sellerId}/products`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((response) => {
      // Limpiar la lista de productos antes de agregar los nuevos
      const dashboard = document.querySelector(".seller-dashboard");
      dashboard.innerHTML = ''; // Limpia el contenido anterior

      response.data.forEach((product) => {
        console.log(product);
        dashboard.appendChild(createSellerItemCard(product));
      });
    });
};

function createSellerItemCard(product) {
  // Crear contenedor principal
  const card = document.createElement("div");
  card.className = "seller-item-card";

  // Crear imagen del producto
  const img = document.createElement("img");
  img.src = product.image;
  img.alt = product.name;
  card.appendChild(img);

  // Crear información del producto
  const infoDiv = document.createElement("div");
  infoDiv.className = "seller-item-info";

  const title = document.createElement("h3");
  title.textContent = product.name;

  const price = document.createElement("p");
  price.textContent = `Precio: $${product.current_price}`;

  const publishDate = document.createElement("p");
  publishDate.textContent = `Fecha de publicación: ${product.publishDate}`;

  infoDiv.appendChild(title);
  infoDiv.appendChild(price);
  infoDiv.appendChild(publishDate);
  card.appendChild(infoDiv);

  // Crear botones de acción
  const actionDiv = document.createElement("div");
  actionDiv.className = "seller-action-buttons";

  const editButton = document.createElement("button");
  editButton.className = "edit-item";
  editButton.textContent = "Editar";

  const deleteButton = document.createElement("button");
  deleteButton.className = "delete-item";
  deleteButton.textContent = "Eliminar";

  const pauseButton = document.createElement("button");
  pauseButton.className = "pause-item";
  pauseButton.textContent = "Pausar";

  actionDiv.appendChild(editButton);
  actionDiv.appendChild(deleteButton);
  actionDiv.appendChild(pauseButton);
  card.appendChild(actionDiv);

  return card;
}

// Evento para crear un producto y luego actualizar la lista
const form = document.querySelector("#create-form");
form.addEventListener("submit", function (event) {
  event.preventDefault();
  const formData = new FormData(this);
  const data = {};
  formData.forEach((value, key) => {
    data[key] = value;
  });
  createProduct(data); // Crear el producto y actualizar la lista
});

// Cargar los productos inicialmente
getProductsBySeller(localStorage.getItem("sellerId"));