const cartTable = document.querySelector(".cart-table");

function createCartLine(product = {}) {
  const cartLine = document.createElement("tr");
  cartLine.className = "cart-line";
  cartLine.dataset.id = product.id;

  const lineImg = document.createElement("td");
  lineImg.className = "line-img";
  const productImage = document.createElement("img");
  productImage.src = product.image.src;
  productImage.alt = product.image.alt;
  lineImg.appendChild(productImage);

  const lineInfo = document.createElement("td");
  lineInfo.className = "line-info";

  const productName = document.createElement("span");
  productName.className = "product-name";
  productName.textContent = product.name;
  lineInfo.appendChild(productName);

  const sellerName = document.createElement("span");
  sellerName.className = "seller-name";
  sellerName.textContent = product.sellerName;
  lineInfo.appendChild(sellerName);

  const lineActions = document.createElement("td");
  lineActions.className = "line-actions";

  const quantityControll = document.createElement("div");
  quantityControll.className = "quantity-controll";

  const quantitySelector = document.createElement("div");
  quantitySelector.className = "quantity-selector";
  const decreaseButton = document.createElement("button");
  decreaseButton.className = "quantity-btn decrease";
  decreaseButton.textContent = "-";
  decreaseButton.addEventListener("click", () => {
    updateQuantity(product.id, 0);
  });
  const quantityInput = document.createElement("span");
  quantityInput.className = "quantity-input";
  quantityInput.textContent = product.quantity;
  const increaseButton = document.createElement("button");
  increaseButton.className = "quantity-btn increase";
  increaseButton.textContent = "+";
  increaseButton.addEventListener("click", () => {
    updateQuantity(product.id, 1);
  });
  quantitySelector.appendChild(decreaseButton);
  quantitySelector.appendChild(quantityInput);
  quantitySelector.appendChild(increaseButton);
  quantityControll.appendChild(quantitySelector);

  const productStock = document.createElement("span");
  productStock.className = "product-stock";
  productStock.textContent = `Disponible: ${product.stock}`;

  quantityControll.appendChild(productStock);

  lineActions.appendChild(quantityControll);

  const deleteButton = document.createElement("button");
  deleteButton.className = "delete-btn";
  deleteButton.textContent = "Eliminar";
  deleteButton.onclick = () => {
    deleteProduct(product.id, cartLine);
  };
  lineActions.appendChild(deleteButton);

  const linePrices = document.createElement("td");
  linePrices.className = "line-prices";

  const discountContainer = document.createElement("div");
  discountContainer.className = "discount-container";
  const discountSpan = document.createElement("span");
  discountSpan.className = "product-discount";
  discountSpan.textContent = `-${(
    (1 - product.currentPrice / product.lastPrice) *
    100
  ).toFixed(2)}%`;

  discountContainer.appendChild(discountSpan);
  const lastPriceSpan = document.createElement("span");
  lastPriceSpan.className = "last-price";
  lastPriceSpan.textContent = `$${product.lastPrice.toFixed(2)}`;
  discountContainer.appendChild(lastPriceSpan);

  const currentPriceSpan = document.createElement("span");
  currentPriceSpan.className = "current-price";
  currentPriceSpan.textContent = `$${product.currentPrice.toFixed(2)}`;

  linePrices.appendChild(discountContainer);
  linePrices.appendChild(currentPriceSpan);

  cartLine.appendChild(lineImg);
  cartLine.appendChild(lineInfo);
  cartLine.appendChild(lineActions);
  cartLine.appendChild(linePrices);
  return cartLine;
}

function updateQuantity(productId, isSum) {
  // Encuentra el producto por su id
  const product = products.find((product) => product.id === productId);

  if (product) {
    const quantityInput = document.querySelector(
      `.cart-line[data-id="${productId}"] .quantity-input`
    );
    let quantityValue = parseInt(quantityInput.textContent);

    if (isSum && product.quantity < product.stock) {
      quantityValue++;
      product.quantity = quantityValue;
    } else if (!isSum && product.quantity > 1) {
      quantityValue--;
      product.quantity = quantityValue;
    }

    quantityInput.textContent = quantityValue;
  }
}

function deleteProduct(productId, cartLine) {
  // Encuentra el índice del producto por su id
  const productIndex = products.findIndex(
    (product) => product.id === productId
  );

  if (productIndex !== -1) {
    products.splice(productIndex, 1);
    cartLine.remove();
  }
}

// TEMPORALMENTE ES VAR
var products = [
  {
    id: 1,
    name: "Product 1",
    lastPrice: 16,
    currentPrice: 11,
    quantity: 1,
    stock: 10,
    sellerName: "Seller 1",
    image: {
      src: "https://picsum.photos/200/200",
      alt: "Product 1 image",
    },
  },
  {
    id: 2,
    name: "Product 2",
    lastPrice: 24,
    currentPrice: 16,
    quantity: 2,
    stock: 15,
    sellerName: "Seller 1",
    image: {
      src: "https://picsum.photos/200/200",
      alt: "Product 2 image",
    },
  },
];
products = [];
function getCartProducts() {
  const cartContainer = document.querySelector(".cart-container");
  if (products.length != 0) {
    renderCart(cartContainer);
    renderSummary(cartContainer, products);
  } else {
    renderDefaultCart(cartContainer);
    renderDefaultSummary(cartContainer);
  }
  return;
  // obtener los productos del carrito con fetch
  fetch("/api/cart....")
    .then((response) => response.json())
    .then((data) => {
      products = data;
      renderCart();
    })
    .catch((error) => console.error("Error:", error));
}

function renderCart(cartContainer) {
  const cartMain = document.createElement("div");
  cartMain.className = "cart-main";

  const cartSubtitle = document.createElement("h2");
  cartSubtitle.className = "cart-subtitle";
  cartSubtitle.textContent = "Tus productos agregados al carrito";

  const tableScroll = document.createElement("div");
  tableScroll.className = "table-scroll";

  const cartTable = document.createElement("table");
  cartTable.className = "cart-table";

  const cartTableBody = document.createElement("tbody");
  cartTable.appendChild(cartTableBody);

  tableScroll.appendChild(cartTable);

  products.forEach((product) => {
    cartTableBody.appendChild(createCartLine(product));
  });

  cartMain.appendChild(cartSubtitle);
  cartMain.appendChild(tableScroll);

  cartContainer.appendChild(cartMain);
}

function renderSummary(cartContainer) {
  let summary = {
    subtotal: 0,
    discounts: 0,
  };
  products.forEach((product) => {
    summary.subtotal += product.currentPrice;
    summary.discounts += product.lastPrice - product.currentPrice;
  });
  summary.subtotal = summary.subtotal.toFixed(2);
  summary.discounts = summary.discounts.toFixed(2);

  const orderSummary = document.createElement("div");
  orderSummary.className = "order-summary";

  const summaryTitle = document.createElement("h2");
  summaryTitle.className = "order-title";
  summaryTitle.textContent = "Resumen de tu orden";

  const shippingButton = document.createElement("button");
  shippingButton.className = "shipping-btn";
  shippingButton.textContent = "Elige Método de Envío";

  orderSummary.appendChild(summaryTitle);
  orderSummary.append(
    createSummaryLine("Subtotal", summary.subtotal),
    createSummaryLine("Descuentos", summary.discounts),
    createSummaryLine("Envío", shippingButton),
    createSummaryLine(
      "Total: ",
      (summary.subtotal - summary.discounts).toFixed(2)
    )
  );

  const finishOrderBtn = document.createElement("button");
  finishOrderBtn.className = "finish-order-btn";
  finishOrderBtn.textContent = "Finalizar Pedido";
  finishOrderBtn.onclick = () => {
    finishOrder();
  };

  orderSummary.appendChild(finishOrderBtn);

  cartContainer.appendChild(orderSummary);
}

function createSummaryLine(name, value) {
  const summaryLine = document.createElement("div");
  summaryLine.className = "summary-line";

  const summaryLineName = document.createElement("span");
  summaryLineName.className = "summary-line-name";
  summaryLineName.textContent = name;

  const summaryLineValue = document.createElement("span");
  summaryLineValue.className = "summary-line-value";
  if (value instanceof Node) {
    summaryLineValue.appendChild(value);
  } else {
    summaryLineValue.textContent = value;
  }

  summaryLine.appendChild(summaryLineName);
  summaryLine.appendChild(summaryLineValue);

  return summaryLine;
}

function renderDefaultCart(cartContainer) {
  const defaultCartMain = document.createElement("div");
  defaultCartMain.className = "cart-main default";

  const cartIcon = document.createElement("img");
  cartIcon.className = "cart-icon";
  cartIcon.src = "/img/icons/carrito_icono.png";
  cartIcon.alt = "Icono del carrito";

  const infoContainer = document.createElement("div");
  infoContainer.className = "info-container";

  const cartSubtitle = document.createElement("h2");
  cartSubtitle.className = "cart-subtitle default";
  cartSubtitle.textContent = "Tu carrito está vacío";

  const cartAd = document.createElement("p");
  cartAd.className = "cart-ad";
  cartAd.textContent = "¡Cuando agregues productos, aparecerán aquí!";

  infoContainer.appendChild(cartSubtitle);
  infoContainer.appendChild(cartAd);

  const discoverProductsBtn = document.createElement("button");
  discoverProductsBtn.className = "discover-products-btn";
  discoverProductsBtn.textContent = "Descubrir productos";
  discoverProductsBtn.onclick = () => {
    window.location.href = "/";
  };

  infoContainer.appendChild(discoverProductsBtn);
  defaultCartMain.appendChild(cartIcon);
  defaultCartMain.appendChild(infoContainer);

  cartContainer.appendChild(defaultCartMain);
}

function renderDefaultSummary(cartContainer) {
  const defaultOrderSummary = document.createElement("div");
  defaultOrderSummary.className = "order-summary default";

  const summaryTitle = document.createElement("h2");
  summaryTitle.className = "order-title";
  summaryTitle.textContent = "Resumen de tu orden";

  const summaryAd = document.createElement("p");
  summaryAd.className = "order-ad";
  summaryAd.textContent =
    "Aquí podrás ver los montos de tu compra cuando añadas productos.";

  defaultOrderSummary.appendChild(summaryTitle);
  defaultOrderSummary.appendChild(summaryAd);

  cartContainer.appendChild(defaultOrderSummary);
}

function finishOrder() {
  alert("Pedido Realizado (dev)");
}

getCartProducts();
