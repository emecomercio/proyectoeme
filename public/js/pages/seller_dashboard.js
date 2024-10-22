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
        throw new Error("Error al crear el producto");
      }
      return response.json();
    })
    .then((responseData) => {
      console.log(responseData);
      // Después de crear el producto, vuelve a cargar la lista de productos
      getProductsBySeller(data["seller-id"]);
    })
    .catch((error) => {
      console.error("Error:", error);
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
      const dashboard = document.querySelector(".product-dashboard");
      dashboard.innerHTML = ""; // Limpia el contenido anterior

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

let dashboardSections = document.querySelectorAll(".all-container section");
let sidebarBtns = document.querySelectorAll(".sidebar-item");
sidebarBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    dashboardSections.forEach((section) => {
      if (btn.getAttribute("data-target") != section.id) {
        section.classList.remove("active");
      } else {
        section.classList.add("active");
      }
    });
  });
});

// Cargar los productos inicialmente
getProductsBySeller(localStorage.getItem("sellerId"));

// Obtener el dropdown y los contenedores de los mapas
let correosDropdown = document.getElementById("correos-dropdown");
let mapsSections = document.querySelectorAll(".maps-display div");

// Escuchar cuando el usuario selecciona una oficina del dropdown
correosDropdown.addEventListener("change", function () {
  let selectedTarget =
    this.options[this.selectedIndex].getAttribute("data-target");

  // Ocultar todos los mapas
  mapsSections.forEach((mapSection) => {
    mapSection.classList.remove("active");
  });

  // Mostrar el mapa correspondiente a la oficina seleccionada
  let selectedMap = document.getElementById(selectedTarget);
  if (selectedMap) {
    selectedMap.classList.add("active");
  }
});

// Datos fijos representando ventas del último mes
const data = {
  labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D'], // Etiquetas de productos
  datasets: [
    {
      label: 'Cantidad Vendida', // Cantidad de productos vendidos
      data: [15, 30, 8, 12], // Datos de cantidad
      backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    },
    {
      label: 'Ganancias ($)', // Ganancias en dólares
      data: [250, 400, 120, 350], // Datos de ganancias
      backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color de las barras de ganancias
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1
    }
  ]
};

// Configuración del gráfico
const config = {
  type: 'bar',
  data: data,
  options: {
    responsive: false, // Desactiva el ajuste automático de tamaño
    maintainAspectRatio: false, // Permite controlar el tamaño manualmente
    scales: {
      x: { 
        grid: {
          display: false // Oculta las líneas de la grilla del eje X
        },
        title: {
          display: true,
          text: 'Productos',
          font: {
            size: 16,
            weight: 'bold'
          }
        }
      },
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Cantidad / Ganancias ($)',
          font: {
            size: 16,
            weight: 'bold'
          }
        }
      }
    },
    plugins: {
      legend: {
        labels: {
          font: {
            size: 14
          }
        }
      }
    }
  }
};

// Renderiza el gráfico
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, config);

// Seleccionar todas las secciones
let sections = document.querySelectorAll(".section");

// Obtener los botones de navegación
let nextStep1 = document.getElementById("next-step-1");
let cancelStep1 = document.getElementById("cancel-step-1");

let nextStep2 = document.getElementById("next-step-2");
let cancelStep2 = document.getElementById("cancel-step-2");

let cancelStep3 = document.getElementById("cancel-step-3");

// Función para ocultar todas las secciones
function hideAllSections() {
  sections.forEach(section => {
    section.classList.remove("active");
  });
}

// Navegar a la siguiente sección
function showSection(sectionId) {
  hideAllSections();
  let section = document.getElementById(sectionId);
  if (section) {
    section.classList.add("active");
  }
}

// Eventos para los botones de navegación
nextStep1.addEventListener("click", function () {
  showSection("add-variants");
});

cancelStep1.addEventListener("click", function () {
  // Aquí puedes definir la acción de cancelar si es necesario
  alert("Operación cancelada en paso 1");
});

nextStep2.addEventListener("click", function () {
  showSection("upload-images");
});

cancelStep2.addEventListener("click", function () {
  showSection("create-product");
});

cancelStep3.addEventListener("click", function () {
  showSection("add-variants");
});

document.addEventListener("DOMContentLoaded", function() {
  const descriptionField = document.getElementById("description");
  const charCount = document.getElementById("charCount");

  descriptionField.addEventListener("input", function() {
      const currentLength = descriptionField.value.length;
      charCount.textContent = `${currentLength}/350`;

      // Si llega a 300 caracteres, cambia el color del contador
      if (currentLength >= 300) {
          charCount.classList.add("limit-reached");
          descriptionField.value = descriptionField.value.substring(0, 350);  // Evita escribir más de 300 caracteres
      } else {
          charCount.classList.remove("limit-reached");
      }
  });
});