window.onload = function() {
    setTimeout(function() {
        // Mostrar el modal
        document.getElementById("register-modal").style.display = "block";
    }, 120000); // // 2 minutos en milisegundos
};

// Cierra el modal cuando se hace clic en el botón de cerrar
document.querySelector(".close-button").addEventListener("click", function() {
    document.getElementById("register-modal").style.display = "none";
});

// Opcional: cerrar el modal si el usuario hace clic fuera de él
window.addEventListener("click", function(event) {
    let modal = document.getElementById("register-modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
