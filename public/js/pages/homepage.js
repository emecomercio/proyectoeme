import { cookiesAlert } from "../components/cookies_alert.js";
import { productColorSelector } from "../components/product_color_selector.js";
import { productsGrid } from "../components/products_grid.js";

cookiesAlert();
productColorSelector();
productsGrid();

const carousel = document.querySelector(".carousel");
const carouselInner = carousel.querySelector(".carousel-inner");
const items = carousel.querySelectorAll(".carousel-item");
const prevBtn = carousel.querySelector(".prev");
const nextBtn = carousel.querySelector(".next");

let currentIndex = 0;

function showSlide(index) {
  if (index < 0) {
    currentIndex = items.length - 1;
  } else if (index >= items.length) {
    currentIndex = 0;
  } else {
    currentIndex = index;
  }
  carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
}

prevBtn.addEventListener("click", () => showSlide(currentIndex - 1));
nextBtn.addEventListener("click", () => showSlide(currentIndex + 1));

// Optional: Auto-play
setInterval(() => showSlide(currentIndex + 1), 5000);

// LOGOUT FORM
document.getElementById("logout-btn").addEventListener("click", () => {
  fetch("/api/logout", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      if (data.status === "success") {
        window.location.href = "/login";
      } else {
        alert("Error logging out");
      }
    });
});
