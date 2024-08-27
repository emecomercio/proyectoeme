export function recommended() {
  const container = document.querySelector(".recommended-products-container");
  const btnLeft = document.querySelector(".scroll-button.left");
  const btnRight = document.querySelector(".scroll-button.right");

  btnLeft.addEventListener("click", () => {
    container.scrollBy({ left: -200, behavior: "smooth" });
  });

  btnRight.addEventListener("click", () => {
    container.scrollBy({ left: 200, behavior: "smooth" });
  });
}
