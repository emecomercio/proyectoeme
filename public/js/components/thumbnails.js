export function thumbnails() {
  const mainImage = document.getElementById("main-product-image");
  const thumbnails = document.querySelectorAll(".thumbnail-image");

  // Función para cambiar la imagen principal al hacer clic en una miniatura
  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", function () {
      mainImage.src = this.src;
    });
  });

  // Función para activar el zoom sobre la imagen principal al hacer clic
  mainImage.addEventListener("click", function () {
    this.classList.toggle("zoomed");
    this.style.transform = this.classList.contains("zoomed")
      ? "scale(2)"
      : "scale(1)";
    this.style.transition = "transform 0.3s ease";
  });

  // Función para activar el zoom cuando el ratón está sobre la imagen principal
  mainImage.addEventListener("mouseenter", function () {
    if (!this.classList.contains("zoomed")) {
      this.style.transform = "scale(1.2)"; // Zoom al 120%
    }
  });

  // Función para desactivar el zoom cuando el ratón sale de la imagen principal
  mainImage.addEventListener("mouseleave", function () {
    if (!this.classList.contains("zoomed")) {
      this.style.transform = "scale(1)"; // Vuelve al 100%
    }
  });
}
