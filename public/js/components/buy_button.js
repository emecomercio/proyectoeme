export function buyButton() {
  const buyButton = document.querySelector(".buy-button");

  buyButton.addEventListener("click", function () {
    this.classList.add("checked");

    setTimeout(() => {
      this.classList.remove("checked");
    }, 1500); // Duración de la animación
  });
}
