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
/*
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
*/

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
    previousButton.textContent = "Atrás";
    previousButton.className = "previous-btn";
    nextButton.textContent = "Crear publicación";
  } else {
    alert("creado");
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
  } else {
    alert("borrado");
  }
});

// SECCION DE ATRIBUTOS
var productAttributes = [];
const productAttrSection = document.querySelector(".product-attributes");
const attributesList = document.querySelector(".attributes-list>ul");
const variantsTable = document.querySelector(".variants-table>tbody");
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
  const attributeName = document.querySelector("#attribute-name").value;
  if (!attributeName) {
    alert("Ingrese un nombre de atributo");
    return; //crear un modal de alerta
  }

  // No hay atributos
  if (!attributesList.querySelector(".product-attribute")) {
    const attribute = createAtributte(attributeName);
    attributesList.appendChild(attribute);
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
  }
});

var currentVariantRow = 0;
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
  variantPrice.value = "0.00";
  variantPrice.setAttribute("data-variant", currentVariantRow + 1);
  variantPriceCell.appendChild(variantPrice);

  const variantStockCell = document.createElement("td");
  variantStockCell.className = "variant-stock";
  const variantStock = document.createElement("input");
  variantStock.type = "number";
  variantStock.step = "1";
  variantStock.min = "0";
  variantStock.max = "1000000";
  variantStock.value = "0";
  variantStock.setAttribute("data-variant", currentVariantRow + 1);
  variantStockCell.appendChild(variantStock);

  const variantActions = document.createElement("td");
  variantActions.className = "variant-actions";
  const deleteVariantBtn = document.createElement("button");
  deleteVariantBtn.textContent = "Eliminar";
  deleteVariantBtn.className = "delete-variant-btn";
  deleteVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    variant.remove(); //agregar logica de la variante
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
  });
  const attributesVariantBtn = document.createElement("button");
  attributesVariantBtn.textContent = "Atributos";
  attributesVariantBtn.className = "attributes-variant-btn";
  attributesVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    showAttributesLoader();
  });
  const imagesVariantBtn = document.createElement("button");
  imagesVariantBtn.textContent = "Imágenes";
  imagesVariantBtn.className = "images-variant-btn";
  imagesVariantBtn.addEventListener("click", (e) => {
    e.preventDefault();
    showImgLoader();
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

const addVariant = document.querySelector(".add-variant-btn");
addVariant.addEventListener("click", (e) => {
  e.preventDefault();
  let variant = createVariantRow();
  variantsTable.appendChild(variant);
});
let variant = createVariantRow();
variantsTable.appendChild(variant);

// CARGA DE IMAGENES
function createImgLoader() {
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

  imgForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!imgSelectorInput.files.length) {
      alert("Por favor, seleccione una imagen"); //hacer un modal
      return;
    }

    //logica back
    // tomar la imagen desde  el input files
    const image = imgSelectorInput.files[0];
    const src = URL.createObjectURL(image);
    const alt = imgAltInput.value;

    imgSelectorLabel.textContent = "Seleccionar imagen";
    imgForm.reset();
    addVariantImg(src, alt);
  });

  const imgGallery = document.createElement("div");
  imgGallery.className = "img-gallery";

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

function addVariantImg(src, alt) {
  const imgGallery = document.querySelector(".img-gallery");
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
  imgGallery.appendChild(galleryItem);
}

function showImgLoader() {
  if (document.querySelector(".img-loader")) {
    document.querySelector(".img-loader").remove();
  }
  const imgLoader = createImgLoader();
  document.body.appendChild(imgLoader);
}
function showAttributesLoader() {
  if (document.querySelector(".attributes-loader")) {
    document.querySelector(".attributes-loader").remove();
  }
  const attributesLoader = createAtributtesLoader();
  document.body.appendChild(attributesLoader);
}

// CARGA DE ATRIBUTOS
function createAtributtesLoader() {
  // MODAL
  const attributesLoader = document.createElement("dialog");
  attributesLoader.className = "attributes-loader";
  const attributesLoaderHeader = document.createElement("h2");
  attributesLoaderHeader.textContent = "Cargar atributos";
  attributesLoader.appendChild(attributesLoaderHeader);

  // FORM

  const attributesForm = document.createElement("form");
  attributesForm.className = "attributes-form";

  productAttributes.forEach((attribute) => {
    const attributeRow = document.createElement("div");
    attributeRow.className = "attribute-row";

    const attributeLabel = document.createElement("label");
    attributeLabel.textContent = `${attribute}: `;
    attributeLabel.setAttribute("for", attribute);

    const attributeInput = document.createElement("input");
    attributeInput.type = "text";
    attributeInput.name = attribute;
    attributeInput.id = attribute;
    attributeInput.placeholder = attribute;
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
    attributesLoader.remove();
  });
  attributesLoaderBtns.appendChild(closeBtn);
  attributesLoaderBtns.appendChild(acceptBtn);

  attributesLoader.appendChild(attributesForm);
  attributesLoader.appendChild(attributesLoaderBtns);
  return attributesLoader;
}
