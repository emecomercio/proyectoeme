import { performSearch } from "../components/perform_search.js";

const urlParams = new URLSearchParams(window.location.search);
const query = urlParams.get("query");

if (query) {
  let products = await performSearch(query);
  products.forEach((product) => {
    document
      .querySelector(".search-results")
      .appendChild(createResultCard(product));
  });
} else {
  alert("No se encontró una búsqueda válida");
  console.error("No se encontró una búsqueda válida");
}

function createResultCard(product) {
  const resultCard = document.createElement("article");
  resultCard.className = "result-card";

  const resultImgDiv = document.createElement("div");
  resultImgDiv.className = "result-img";
  const resultImg = document.createElement("img");
  resultImg.src = product.image.src;
  resultImg.alt = product.image.alt;

  resultImgDiv.appendChild(resultImg);

  const resultInfoDiv = document.createElement("div");
  resultInfoDiv.className = "result-info";

  const resultName = document.createElement("h1");
  resultName.className = "result-name";
  resultName.textContent = product.name;
  const resultSeller = document.createElement("span");
  resultSeller.className = "result-seller";
  resultSeller.textContent = product.sellerName;

  resultInfoDiv.appendChild(resultName);
  resultInfoDiv.appendChild(resultSeller);

  const resultPrices = document.createElement("div");
  resultPrices.className = "prices-container";

  let discountAmount = calculateDiscount(
    product.lastPrice,
    product.currentPrice
  );

  const currentPrice = document.createElement("span");
  currentPrice.className = "current-price";
  currentPrice.textContent = `$ ${product.currentPrice.toFixed(2)}`;
  const lastPrice = document.createElement("span");
  lastPrice.className = "last-price";
  lastPrice.textContent = discountAmount == null ? "" : product.lastPrice;
  const discount = document.createElement("span");
  discount.className = "discount";

  discount.textContent = discountAmount == null ? "" : `-${discountAmount}%`;

  resultInfoDiv.appendChild(resultPrices);

  resultPrices.appendChild(currentPrice);
  resultPrices.appendChild(lastPrice);
  resultPrices.appendChild(discount);

  resultCard.appendChild(resultImgDiv);
  resultCard.appendChild(resultInfoDiv);
  return resultCard;
}

function calculateDiscount(lastPrice, currentPrice) {
  if (lastPrice <= currentPrice) return null;

  let discount = (1 - currentPrice / lastPrice) * 100;

  return discount.toFixed(2);
}
