// AGREGAR AL CARRITO
async function getCart() {
  try {
    const response = await fetch("/api/carts/current");

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const result = await response.json();

    if (result.status !== "success") {
      console.log(result.message);
      return null;
    }

    return result.data.cart;
  } catch (error) {
    console.error("Error fetching the cart:", error);
    return null;
  }
}

async function addToCart(product) {
  let cart = await getCart();
  if (cart) {
    fetch(`/api/carts/current/lines`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(product),
      credentials: "include",
    })
      .then((response) => response.json())
      .then((result) => {
        console.log(result);
        return result.data.cart;
      })
      .then((cart) => {
        console.log(cart);
      });
  }
}

var path = window.location.pathname;
var segments = path.split("/");
var productId = segments[2];
var variantNumber = segments[3];
// Esto habria que hacerlo con fetch
var currentVariant = product.variants[variantNumber];

const addBtn = document.querySelector("#add-to-cart-button");

addBtn.addEventListener("click", function () {
  const user = localStorage.getItem("user");

  if (user && JSON.parse(user).role === "buyer") {
    let quantity = parseInt(document.querySelector("#quantity").value);

    let product = {
      id: productId,
      variant: currentVariant,
      quantity: quantity,
    };
    addToCart(product);
  } else {
    let [modal, loginBtn, registerBtn] = createModal(
      "Atencion",
      "Para agregar productos a tu carrito, primero debes iniciar sesión. Si no tienes una cuenta, puedes registrarte.",
      ["Iniciar Sesion", "Registrarse"],
      ["#28a745", "blue"]
    );
    showModal(modal);
    loginBtn.onclick = () => {
      window.location.href = "/login";
    };
    registerBtn.onclick = () => {
      window.location.href = "/register/buyer";
    };
  }
});

// MANEJO DE ATRIBUTOS DINAMICO
const attributes = getUniqueAttributes(product.variants);

const ProductAttributes = document.querySelector(".product-attributes");

Object.keys(attributes).forEach((key) => {
  let values = [];
  attributes[key].forEach((value) => {
    values.push(value);
  });
  let attribute = createAtribute(key, values);
  ProductAttributes.appendChild(attribute);
});

renderAttributes(product.variants[variantNumber]);
loadImages(product.variants[variantNumber]);

//Función para obtener atributos únicos de todas las variantes
function getUniqueAttributes(variants) {
  const attributesMap = {};

  variants.forEach((variant) => {
    variant.attributes.forEach((attribute) => {
      if (!attributesMap[attribute.name]) {
        attributesMap[attribute.name] = new Set();
      }
      attributesMap[attribute.name].add(attribute.value);
    });
  });

  return attributesMap;
}

function createAtribute(name, values) {
  const Attribute = document.createElement("div");
  Attribute.classList.add("attribute");
  const AttributesValuesContainer = document.createElement("div");
  AttributesValuesContainer.classList.add("attribute-values");

  const AttributeName = document.createElement("p");
  AttributeName.classList.add("attribute-name");
  AttributeName.dataset.name = name;
  AttributeName.textContent = name + ": ";

  values.forEach((value) => {
    const AttributeValue = document.createElement("div");
    AttributeValue.classList.add("attribute-value");
    AttributeValue.dataset.attribute = name;
    AttributeValue.dataset.value = value;
    AttributeValue.textContent = value;
    AttributesValuesContainer.appendChild(AttributeValue);
  });

  Attribute.appendChild(AttributeName);
  Attribute.appendChild(AttributesValuesContainer);
  return Attribute;
}

function renderAttributes(variant) {
  // Iterar sobre cada atributo de la variante seleccionada
  variant.attributes.forEach((attribute) => {
    const selectedElement = document.querySelector(
      `.attribute-value[data-attribute="${attribute.name}"][data-value="${attribute.value}"]`
    );

    // Desmarcar todos los elementos del mismo atributo
    const allElements = document.querySelectorAll(
      `.attribute-value[data-attribute="${attribute.name}"]`
    );

    allElements.forEach((el) => {
      el.classList.remove("selected");
    });

    // Seleccionar el elemento correspondiente a la variante actual
    if (selectedElement) {
      selectedElement.classList.add("selected");
    }
  });

  // Deshabilitar combinaciones no válidas
  disableInvalidCombinations(variant);
}

function disableInvalidCombinations(selectedVariant) {
  // Obtener los atributos seleccionados hasta el momento
  const selectedAttributes = selectedVariant.attributes.reduce(
    (acc, attribute) => {
      acc[attribute.name] = attribute.value;
      return acc;
    },
    {}
  );

  // Iterar sobre todos los valores de atributos en el DOM
  document.querySelectorAll(".attribute-value").forEach((element) => {
    const attributeName = element.getAttribute("data-attribute");
    const attributeValue = element.getAttribute("data-value");

    // Clonar los atributos seleccionados
    const tempSelectedAttributes = { ...selectedAttributes };

    // Simular la selección de este valor de atributo
    tempSelectedAttributes[attributeName] = attributeValue;

    // Comprobar si existe alguna variante que concuerde con la combinación
    const matchingVariant = product.variants.find((variant) => {
      return variant.attributes.every((attr) => {
        return tempSelectedAttributes[attr.name] === attr.value;
      });
    });

    // Si no hay variante que coincida, deshabilitar el valor
    if (!matchingVariant) {
      element.classList.add("disabled");
    } else {
      element.classList.remove("disabled");
    }
  });
}

// Objeto para almacenar los atributos seleccionados
let selectedAttributes = {};
let lastSelectedAttribute = [];

document.querySelectorAll(".attribute").forEach((attributeElement) => {
  const attributeName =
    attributeElement.querySelector(".attribute-name").dataset.name;
  const selectedValue = attributeElement.querySelector(
    ".attribute-value.selected"
  );
  if (selectedValue) {
    selectedAttributes[attributeName] =
      selectedValue.getAttribute("data-value");
  }
});

document.querySelectorAll(".attribute-value").forEach((element) => {
  element.addEventListener("click", (e) => {
    if (!element.classList.contains("selected")) {
      const attributeName = element.getAttribute("data-attribute");
      const attributeValue = element.getAttribute("data-value");

      document
        .querySelectorAll(`.attribute-value[data-attribute="${attributeName}"]`)
        .forEach((el) => el.classList.remove("selected"));

      element.classList.add("selected");

      selectedAttributes[attributeName] = attributeValue;
      lastSelectedAttribute["name"] = attributeName;
      lastSelectedAttribute["value"] = attributeValue;

      handleAttributeSelection(selectedAttributes);
    }
  });
});

function findExactVariant(selectedAttributes) {
  return product.variants.find((variant) => {
    return variant.attributes.every(
      (attribute) => selectedAttributes[attribute.name] === attribute.value
    );
  });
}

function handleAttributeSelection(selectedAttributes) {
  const exactVariant = findExactVariant(selectedAttributes);
  let matchingVariant;
  if (exactVariant) {
    matchingVariant = exactVariant;
    console.log("Variante exacta encontrada:", matchingVariant);
    // Aquí puedes hacer algo con la variante exacta, como mostrar su información
  } else {
    console.log("No se encontró variante exacta.");
    // Aquí manejaremos la búsqueda de la variante más cercana
    matchingVariant = findBestMatchingVariant(selectedAttributes);
  }

  autocompleteAttributes(matchingVariant);
}

// Función para encontrar la variante que más coincida
function findBestMatchingVariant(selectedAttributes) {
  let bestMatch = null;
  let maxMatches = 0;

  product.variants.forEach((variant) => {
    // Verificar si la variante contiene el nuevo valor seleccionado
    const isLastValuePresent = variant.attributes.some(
      (attribute) =>
        attribute.name === lastSelectedAttribute["name"] &&
        attribute.value === lastSelectedAttribute["value"]
    );

    // Solo contar coincidencias si el último valor está presente en la variante
    if (isLastValuePresent) {
      let matches = 0;

      variant.attributes.forEach((attribute) => {
        // Contar coincidencias
        if (selectedAttributes[attribute.name] === attribute.value) {
          matches++;
        }
      });

      // Actualizar la mejor coincidencia si se encuentra una mejor
      if (matches > maxMatches) {
        maxMatches = matches;
        bestMatch = variant;
      }
    }
  });

  console.log("Mejor variante coincidente encontrada:", bestMatch);
  return bestMatch;
}

function autocompleteAttributes(bestMatch) {
  currentVariant = bestMatch;
  renderAttributes(bestMatch);
  loadImages(bestMatch);
}

// MANEJO DE IMAGENES DINAMICO

function loadImages(variant) {
  const mainImageContainer = document.querySelector(".product-page__images1");
  mainImageContainer.innerHTML = "";
  const favoriteButton = document.createElement("button");
  favoriteButton.classList.add("favorite-button");
  favoriteButton.innerText = "♡";
  favoriteButton.addEventListener("click", () => {
    favoriteButton.classList.toggle("active");
  });
  mainImageContainer.appendChild(favoriteButton);
  const thumbnailsContainer = document.querySelector(".thumbnail-container");
  thumbnailsContainer.innerHTML = "";

  let images = variant.images;

  images.forEach((image) => {
    let src = image.src;
    const thumbnail = document.createElement("img");
    thumbnail.classList.add("thumbnail");

    if (image != null) {
      thumbnail.src = src;
      thumbnail.alt = image.alt;
    } else {
      thumbnail.src = "";
      thumbnail.alt = "Product Thumbnail";
    }
    thumbnail.addEventListener("click", () => {
      mainImage.src = src;
      mainImage.alt = image.alt;
    });
    thumbnailsContainer.appendChild(thumbnail);
  });
  const mainImage = document.createElement("img");
  if (images[0] != null) {
    mainImage.src = images[0].src;

    mainImage.alt = images[0].alt;
  } else {
    mainImage.src = "";
    mainImage.alt = "Product Image";
  }
  mainImageContainer.appendChild(mainImage);
}
