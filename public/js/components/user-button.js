document.addEventListener('DOMContentLoaded', function() {
    const userMenu = document.getElementById('user-menu');
    const dropdownContent = userMenu.querySelector('.dropdown-content');

    // Mostrar/Ocultar dropdown al hacer clic en el icono de usuario
    userMenu.addEventListener('click', function(event) {
        const isVisible = dropdownContent.style.display === 'block';
        dropdownContent.style.display = isVisible ? 'none' : 'block';
        event.stopPropagation(); // Evita que el clic se propague al window
    });

    // Ocultar dropdown si se hace clic fuera del menú de usuario
    window.addEventListener('click', function(event) {
        if (!event.target.closest('#user-menu')) {
            dropdownContent.style.display = 'none';
        }
    });
});
