document.querySelectorAll('.product-container').forEach(container => {
    // Selecciona las imágenes en miniatura y la imagen principal para el contenedor actual
    const thumbnailImages = container.querySelectorAll('.product-container-img-small img');
    const mainImage = container.querySelector('.product-container-img img');

    // Función para cambiar la imagen principal al hacer clic en una miniatura
    function changeMainImage(event) {
        mainImage.src = event.target.src;
    }

    // Añade un evento click a cada miniatura para cambiar la imagen principal
    thumbnailImages.forEach(thumbnail => {
        thumbnail.addEventListener('click', changeMainImage);
    });

    // Función para activar el zoom sobre la imagen principal
    function activateZoom() {
        mainImage.style.transform = 'scale(1.2)'; // Zoom al 120%
        mainImage.style.transition = 'transform 0.2s'; // Transición suave
    }

    // Función para desactivar el zoom
    function deactivateZoom() {
        mainImage.style.transform = 'scale(1)'; // Zoom al 100%
    }

    // Añade eventos para el zoom
    mainImage.addEventListener('mouseenter', activateZoom);
    mainImage.addEventListener('mouseleave', deactivateZoom);
});
