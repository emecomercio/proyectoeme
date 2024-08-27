export function favoriteButton() {
  document.addEventListener("DOMContentLoaded", () => {
    const favoriteButton = document.querySelector(".favorite-button");

    favoriteButton.addEventListener("click", () => {
      favoriteButton.classList.toggle("active");
    });
  });
}
