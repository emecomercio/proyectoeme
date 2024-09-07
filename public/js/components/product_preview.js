export function productPrerender() {
  document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("imageInput");
    const imagePrerender = document.getElementById("imagePrerender");
    const imageCounter = document.getElementById("imageCounter");
    const maxImages = 5;

    function updateImageCounter() {
      const existingImagesCount = imagePrerender.childElementCount;
      imageCounter.innerHTML = `Fotos ${existingImagesCount}/${maxImages} <br>- Puedes agregar un máximo de 5 fotos en formato .png o .jpeg`;
    }

    function handleImageDelete(event) {
      if (event.target.classList.contains("delete-button")) {
        const imageElement = event.target.parentElement;
        imageElement.remove();
        updateImageCounter(); // Actualizar el contador después de eliminar la imagen
      }
    }

    imageInput.addEventListener("change", function (event) {
      const files = event.target.files;
      const existingImagesCount = imagePrerender.childElementCount;
      const totalImagesCount = existingImagesCount + files.length;

      if (totalImagesCount > maxImages) {
        alert(`Puedes subir un máximo de ${maxImages} imágenes en total.`);
        imageInput.value = ""; // Limpiar el input
        return;
      }

      Array.from(files).forEach((file) => {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();

          reader.onload = function (e) {
            // Verificar si ya hay una imagen existente antes de agregar una nueva
            const existingImageCount =
              imagePrerender.querySelectorAll(".image-container").length;
            if (existingImageCount >= maxImages) {
              alert(`Ya has agregado el máximo de ${maxImages} imágenes.`);
              return;
            }

            const imageContainer = document.createElement("div");
            imageContainer.className = "image-container";

            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.maxWidth = "100px"; // Ajusta el tamaño de la imagen si es necesario
            img.style.margin = "10px";

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Eliminar";
            deleteButton.className = "delete-button";

            imageContainer.appendChild(img);
            imageContainer.appendChild(deleteButton);
            imagePrerender.appendChild(imageContainer);

            updateImageCounter(); // Actualizar el contador después de añadir la imagen
          };

          reader.readAsDataURL(file);
        } else {
          alert("Por favor selecciona solo archivos en .png o .jpeg.");
          imageInput.value = ""; // Limpiar el input si un archivo no es imagen
          return;
        }
      });
    });

    imagePrerender.addEventListener("click", handleImageDelete); // Manejar la eliminación de imágenes

    updateImageCounter(); // Actualizar el contador al cargar la página por primera vez
  });
}
