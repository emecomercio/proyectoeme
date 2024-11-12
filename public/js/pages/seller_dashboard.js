import { uploadProduct } from "../components/seller/upload_product.js";



const hamburgerMenu = document.getElementById('hamburger-menu');
const sidebar = document.querySelector('.sidebar');

hamburgerMenu.addEventListener('click', function () {
  sidebar.classList.toggle('hidden');
});


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
// CAMBIO DE SECCIONES
let dashboardSections = document.querySelectorAll(".all-container>section");
let sidebarBtns = document.querySelectorAll(".sidebar-item");
sidebarBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    dashboardSections.forEach((section) => {
      if (btn.getAttribute("data-target") != section.id) {
        section.classList.add("hidden");
      } else {
        section.classList.remove("hidden");
      }
    });
  });
});

// CARGAR LOS PRODUCTOS INICIALMENTE [EN EL HOME/DASHBOARD]
getProductsBySeller(localStorage.getItem("sellerId"));

// SUBIDA DE PRODUCTOS --> STEPS
const uploadProductSections = document.querySelectorAll(
  "#upload-product>section"
);
const uploadProductSection = document.querySelector("#upload-product");
let stepCounter = 1;
const nextButton = document.querySelector(".next-btn");
const previousButton = document.querySelector(".delete-btn");
nextButton.addEventListener("click", () => {
  if (stepCounter === 1) {
    stepCounter++;
    uploadProductSections.forEach((section) => {
      if (stepCounter == section.dataset.step) {
        section.classList.remove("hidden");
      } else {
        section.classList.add("hidden");
      }
    });
    startProduct();
    previousButton.textContent = "Atrás";
    previousButton.className = "previous-btn";
    nextButton.textContent = "Crear publicación";
    uploadProductSection.dataset.step = stepCounter;
  } else {
    fillVariants();
    product.variants = variants;
    uploadProduct(product);
    //vaciar todo
  }
});
previousButton.addEventListener("click", () => {
  if (stepCounter > 1) {
    stepCounter--;
    uploadProductSections.forEach((section) => {
      if (stepCounter == section.dataset.step) {
        section.classList.remove("hidden");
      } else {
        section.classList.add("hidden");
      }
    });
    nextButton.textContent = "Siguiente";
    previousButton.textContent = "Borrar";
    previousButton.className = "delete-btn";
    uploadProductSection.dataset.step = stepCounter;
  } else {
    alert("borrado");
  }
});

// SECCION DE ATRIBUTOS
let productAttributes = [];
const productAttrSection = document.querySelector(".product-attributes");
const attributesList = document.querySelector(".attributes-list>ul");
function createAtributte(name) {
  const attribute = document.createElement("li");
  const deleteBtn = document.createElement("button");
  deleteBtn.innerHTML = "&#10006;";
  deleteBtn.className = "delete-attribute";
  deleteBtn.addEventListener("click", () => {
    attribute.remove();
    productAttributes.forEach((attr, index) => {
      if (attr == name) {
        productAttributes.splice(index, 1);
      }
    });
  });

  attribute.className = "product-attribute";
  attribute.textContent = name;

  productAttributes.push(name);

  attribute.appendChild(deleteBtn);
  return attribute;
}

const addAttribute = document.querySelector(".add-attribute-btn");
addAttribute.addEventListener("click", (e) => {
  e.preventDefault();
  const attributInput = document.querySelector("#attribute-name");
  const attributeName = attributInput.value;
  if (!attributeName) {
    alert("Ingrese un nombre de atributo");
    return; //crear un modal de alerta
  }

  // No hay atributos
  if (!attributesList.querySelector(".product-attribute")) {
    const attribute = createAtributte(attributeName);
    attributesList.appendChild(attribute);
    attributInput.value = "";
    return;
  }

  // Si llega a este punto es porque ya hay atributos
  let attributeFound = false;
  productAttributes.forEach((attribute) => {
    if (attribute === attributeName) {
      attributeFound = true;
    }
  });

  if (attributeFound) {
    alert("el atributo ya existe");
    return; //crear un modal de alerta
  } else {
    const attribute = createAtributte(attributeName);
    attributesList.appendChild(attribute);
    attributInput.value = "";
  }
});

// CARGA DE VARIANTES
function createVariantRow() {
  const variant = document.createElement("tr");
  variant.className = "variant-row";

  const variantImageCell = document.createElement("td");
  variantImageCell.className = "variant-image";
  const variantImage = document.createElement("img");
  variantImage.src = "";
  variantImage.alt = "def";
  variantImageCell.appendChild(variantImage);

  const variantNumberCell = document.createElement("td");
  variantNumberCell.className = "variant-number";
  variantNumberCell.textContent = currentVariantRow + 1;

  const variantPriceCell = document.createElement("td");
  variantPriceCell.className = "variant-price";
  const variantPrice = document.createElement("input");
  variantPrice.type = "number";
  variantPrice.step = "0.01";
  variantPrice.min = "0";
  variantPrice.max = "1000000";
  variantPrice.placeholder = "0.00";
  variantPrice.setAttribute("data-variant", currentVariantRow + 1);
  variantPriceCell.appendChild(variantPrice);

  const variantStockCell = document.createElement("td");
  variantStockCell.className = "variant-stock";
  const variantStock = document.createElement("input");
  variantStock.type = "number";
  variantStock.step = "1";
  variantStock.min = "0";
  variantStock.max = "1000000";
  variantStock.placeholder = "0";
  variantStock.setAttribute("data-variant", currentVariantRow + 1);
  variantStockCell.appendChild(variantStock);

  const variantActions = document.createElement("td");
  variantActions.className = "variant-actions";
  const deleteVariantBtn = document.createElement("button");
  deleteVariantBtn.textContent = "Eliminar";
  deleteVariantBtn.className = "delete-variant-btn";
  deleteVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentVariantRow == 1) {
      alert("El producto debe tener al menos una variante");
      return;
    }
    if (!confirm("¿Estás seguro de eliminar esta variante?")) {
      return;
    }
    variant.remove();
    const rows = document.querySelectorAll(".variant-row");
    rows.forEach((row, index) => {
      row.cells[1].textContent = index + 1;
      row.cells[2]
        .querySelector("input")
        .setAttribute("data-variant", index + 1);
      row.cells[3]
        .querySelector("input")
        .setAttribute("data-variant", index + 1);
    });
    currentVariantRow--;
    variants.splice(currentVariantRow, 1);
  });
  const attributesVariantBtn = document.createElement("button");
  attributesVariantBtn.textContent = "Atributos";
  attributesVariantBtn.className = "attributes-variant-btn";
  attributesVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    showAttributesLoader(variantNumberCell.textContent - 1);
  });
  const imagesVariantBtn = document.createElement("button");
  imagesVariantBtn.textContent = "Imágenes";
  imagesVariantBtn.className = "images-variant-btn";
  imagesVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    showImgLoader(variantNumberCell.textContent - 1);
  });
  variantActions.appendChild(attributesVariantBtn);
  variantActions.appendChild(imagesVariantBtn);
  variantActions.appendChild(deleteVariantBtn);

  variant.appendChild(variantImageCell);
  variant.appendChild(variantNumberCell);
  variant.appendChild(variantPriceCell);
  variant.appendChild(variantStockCell);
  variant.appendChild(variantActions);
  currentVariantRow++;
  return variant;
}

// CARGA DE IMAGENES
function createImgLoader(index) {
  // MODAL
  const imgLoader = document.createElement("dialog");
  imgLoader.className = "img-loader";
  const imgLoaderHeader = document.createElement("h2");
  imgLoaderHeader.textContent = "Cargar imágenes";
  imgLoader.appendChild(imgLoaderHeader);

  // FORM
  const imgForm = document.createElement("form");
  imgForm.className = "img-form";
  imgForm.enctype = "multipart/form-data";

  const imgSelectorLabel = document.createElement("label");
  imgSelectorLabel.textContent = "Seleccionar imagen";
  const imgSelectorInput = document.createElement("input");
  imgSelectorInput.type = "file";
  imgSelectorInput.name = "image";
  imgSelectorInput.accept = "image/*";
  imgSelectorInput.style.display = "none";
  imgSelectorInput.addEventListener("change", (e) => {
    imgSelectorLabel.textContent =
      e.target.files[0]?.name || "Seleccionar imagen";
  });
  imgSelectorLabel.addEventListener("click", () => {
    imgSelectorInput.click();
  });

  const imgSubmitBtn = document.createElement("button");
  imgSubmitBtn.textContent = "Añadir";
  imgSubmitBtn.type = "submit";

  const imgUploadSection = document.createElement("div");
  imgUploadSection.className = "img-upload-section";
  imgUploadSection.appendChild(imgSelectorLabel);
  imgUploadSection.appendChild(imgSelectorInput);
  imgUploadSection.appendChild(imgSubmitBtn);

  const imgAltInput = document.createElement("input");
  imgAltInput.type = "text";
  imgAltInput.name = "alt";
  imgAltInput.placeholder = "Ingrese el texto alternativo";
  imgAltInput.required = true;

  const imgGallery = document.createElement("div");
  imgGallery.className = "img-gallery";

  imgForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!imgSelectorInput.files.length) {
      alert("Por favor, seleccione una imagen");
      return;
    }

    if (variants[index].images.length < 5) {
      // tomar la imagen desde el input files
      const file = imgSelectorInput.files[0];
      const src = URL.createObjectURL(file);
      const alt = imgAltInput.value;

      createImage(imgGallery, src, alt);
      variants[index].images.push({ file, alt });

      imgSelectorLabel.textContent = "Seleccionar imagen";
      imgForm.reset();
    }

    // Verifica si el límite de imágenes se alcanzó
    if (variants[index].images.length >= 5) {
      imgSelectorInput.disabled = true;
      imgAltInput.disabled = true;
      imgSubmitBtn.disabled = true;
      imgSelectorLabel.textContent = "Límite de imágenes alcanzado";
    }
  });

  // Cargar imágenes por defecto de la variante
  variants[index].images.forEach(({ file, alt }) => {
    const src = URL.createObjectURL(file); // Usa el URL.createObjectURL para mostrar la imagen
    createImage(imgGallery, src, alt);
  });

  //  BOTONES
  const imgLoaderBtns = document.createElement("div");
  imgLoaderBtns.className = "loader-btns";

  const closeBtn = document.createElement("button");
  closeBtn.textContent = "Cerrar";
  closeBtn.addEventListener("click", () => {
    imgLoader.remove();
  });
  const acceptBtn = document.createElement("button");
  acceptBtn.textContent = "Aceptar";
  acceptBtn.addEventListener("click", () => {
    imgLoader.remove();
    setMainImg(index);
  });
  imgLoaderBtns.appendChild(closeBtn);
  imgLoaderBtns.appendChild(acceptBtn);

  imgForm.appendChild(imgUploadSection);
  imgForm.appendChild(imgAltInput);
  imgForm.appendChild(imgGallery);
  imgLoader.appendChild(imgForm);
  imgLoader.appendChild(imgLoaderBtns);
  return imgLoader;
}
let isMain = true;
function createImage(imgGallery, src, alt) {
  const galleryItem = document.createElement("div");
  galleryItem.className = "gallery-item";
  const galleryImg = document.createElement("img");
  galleryImg.src = src;
  galleryImg.alt = alt;

  const itemActions = document.createElement("div");
  itemActions.className = "item-actions";
  const deleteBtn = document.createElement("button");
  deleteBtn.innerHTML = "&#10006;";

  deleteBtn.addEventListener("click", () => {
    //  Eliminar la imagen
  });
  const editBtn = document.createElement("button");
  editBtn.innerHTML = "&#9997;";

  editBtn.addEventListener("click", () => {
    // Editar la imagen
  });
  itemActions.appendChild(deleteBtn);
  itemActions.appendChild(editBtn);
  galleryItem.appendChild(galleryImg);
  galleryItem.appendChild(itemActions);

  if (isMain) {
    const mainItem = document.createElement("div");
    mainItem.className = "main-item";

    mainItem.appendChild(galleryItem);
    imgGallery.appendChild(mainItem);
    isMain = false;
    return;
  }
  imgGallery.appendChild(galleryItem);
}

function showImgLoader(index) {
  if (document.querySelector(".img-loader")) {
    document.querySelector(".img-loader").remove();
  }
  const imgLoader = createImgLoader(index);
  document.body.appendChild(imgLoader);
}
function showAttributesLoader(index) {
  if (document.querySelector(".attributes-loader")) {
    document.querySelector(".attributes-loader").remove();
  }
  const attributesLoader = createAtributtesLoader(index);
  document.body.appendChild(attributesLoader);
}

// CARGA DE ATRIBUTOS
function createAtributtesLoader(index) {
  // MODAL
  const attributesLoader = document.createElement("dialog");
  attributesLoader.className = "attributes-loader";
  const attributesLoaderHeader = document.createElement("h2");
  attributesLoaderHeader.textContent = "Cargar atributos";
  attributesLoader.appendChild(attributesLoaderHeader);

  // FORM
  const attributesForm = document.createElement("form");
  attributesForm.className = "attributes-form";

  const attributes = variants[index].attributes;
  Object.keys(attributes).forEach((attribute) => {
    const attributeRow = document.createElement("div");
    attributeRow.className = "attribute-row";

    const attributeLabel = document.createElement("label");
    attributeLabel.textContent = `${attribute}: `;
    attributeLabel.setAttribute("for", attribute);

    const attributeInput = document.createElement("input");
    attributeInput.type = "text";
    attributeInput.name = attribute;
    attributeInput.id = attribute;
    attributeInput.value = attributes[attribute] ?? "";
    attributeInput.required = true;

    attributeRow.appendChild(attributeLabel);
    attributeRow.appendChild(attributeInput);
    attributesForm.appendChild(attributeRow);
  });

  //  BOTONES
  const attributesLoaderBtns = document.createElement("div");
  attributesLoaderBtns.className = "loader-btns";

  const closeBtn = document.createElement("button");
  closeBtn.textContent = "Cerrar";
  closeBtn.addEventListener("click", () => {
    attributesLoader.remove();
  });
  const acceptBtn = document.createElement("button");
  acceptBtn.textContent = "Aceptar";
  acceptBtn.addEventListener("click", () => {
    let attributes = {};
    attributesForm.querySelectorAll("input").forEach((input) => {
      attributes[input.name] = input.value;
    });
    variants[index].attributes = attributes;
    attributesLoader.remove();
  });
  attributesLoaderBtns.appendChild(closeBtn);
  attributesLoaderBtns.appendChild(acceptBtn);

  attributesLoader.appendChild(attributesForm);
  attributesLoader.appendChild(attributesLoaderBtns);
  return attributesLoader;
}

// MAPAS
function loadGoogleMapsAPI() {
  return new Promise((resolve, reject) => {
    if (window.google && window.google.maps) {
      resolve(); // Google Maps API ya cargada
      return;
    }
    const script = document.createElement("script");
    script.src = "https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY";
    script.async = true;
    script.defer = true;
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
}

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

// GRAFICO
function loadChartJS() {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src = "https://cdn.jsdelivr.net/npm/chart.js";
    script.async = true;
    script.defer = true;
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
}

loadChartJS()
  .then(() => {
    // Datos fijos representando ventas del último mes
    const data = {
      labels: ["Producto A", "Producto B", "Producto C", "Producto D"], // Etiquetas de productos
      datasets: [
        {
          label: "Cantidad Vendida", // Cantidad de productos vendidos
          data: [15, 30, 8, 12], // Datos de cantidad
          backgroundColor: "rgba(54, 162, 235, 0.5)", // Color de las barras
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 1,
        },
        {
          label: "Ganancias ($)", // Ganancias en dólares
          data: [250, 400, 120, 350], // Datos de ganancias
          backgroundColor: "rgba(75, 192, 192, 0.5)", // Color de las barras de ganancias
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    };

    // Configuración del gráfico
    const config = {
      type: "bar",
      data: data,
      options: {
        responsive: false, // Desactiva el ajuste automático de tamaño
        maintainAspectRatio: false, // Permite controlar el tamaño manualmente
        scales: {
          x: {
            grid: {
              display: false, // Oculta las líneas de la grilla del eje X
            },
            title: {
              display: true,
              text: "Productos",
              font: {
                size: 16,
                weight: "bold",
              },
            },
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: "Cantidad / Ganancias ($)",
              font: {
                size: 16,
                weight: "bold",
              },
            },
          },
        },
        plugins: {
          legend: {
            labels: {
              font: {
                size: 14,
              },
            },
          },
        },
      },
    };

    // Renderiza el gráfico
    const ctx = document.getElementById("myChart").getContext("2d");
    const myChart = new Chart(ctx, config);
  })
  .catch((error) => {
    console.error(error);
  });

// SUBIDA DE PRODUCTOS --> VALUES

function createProduct(name, categoryId, description) {
  return {
    name: name,
    categoryId: categoryId,
    description: description,
    variants: [],
  };
}
/**
 * Flag para saber si se está subiendo un producto nuevo o editando uno existente
 */
let productStarted = false;
var product = {};

function startProduct() {
  const productName = document.querySelector("#product-name").value;
  const productCategory = document.querySelector("#product-category").value;
  const productDescription = document.querySelector(
    "#product-description"
  ).value;

  if (!productStarted) {
    productStarted = true;
    product = createProduct(productName, productCategory, productDescription);
    console.log(product);
  } else {
    //crear modal
    product.name = productName;
    product.categoryId = productCategory;
    product.description = productDescription;
    console.log(product);
  }
  startVariantsLoad();
}

var variants = [];
let currentVariantRow = 0;
let variantsStarted = false;
function startVariantsLoad() {
  if (variantsStarted) {
    productAttributes.forEach((attribute) => {
      variants.forEach((variant) => {
        variant.attributes[attribute] =
          variant.attributes[attribute] != ""
            ? variant.attributes[attribute]
            : "";
      });
    });
    return;
  }
  const variantsTable = document.querySelector(".variants-table>tbody");
  const addVariantBtn = document.querySelector(".add-variant-btn");
  addVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    let [variantRow, variant] = [createVariantRow(), createVariant()];
    variants.push(variant);
    variantsTable.appendChild(variantRow);
  });
  variantsStarted = true;
  variants.push(createVariant());
  variantsTable.appendChild(createVariantRow());
}

function createVariant() {
  let attributes = {};
  productAttributes.forEach((attribute) => {
    attributes[attribute] = "";
  });
  return {
    price: 0,
    stock: 0,
    attributes: attributes,
    images: [],
  };
}

/*
variants.forEach((variant, index) => {
  fillVariant(variant, index);
});
*/
function fillVariants() {
  variants.forEach((variant, index) => {
    const variantRow = document.querySelector(
      `.variant-row:nth-child(${index + 1})`
    );
    variant.price = parseFloat(
      variantRow.querySelector(".variant-price>input").value
    );
    variant.stock = parseInt(
      variantRow.querySelector(".variant-stock>input").value
    );
  });
}

function setMainImg(index) {
  const variantImages = document.querySelectorAll(".variant-image>img");
  const src = URL.createObjectURL(variants[index].images[0].file);

  variantImages.forEach((img, i) => {
    if (i === index) {
      img.src = src;
    }
  });
}
