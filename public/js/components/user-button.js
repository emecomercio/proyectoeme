document.addEventListener('DOMContentLoaded', function() {
    const menus = ['user-menu', 'cart-menu'];

    menus.forEach(menuId => {
        const menu = document.getElementById(menuId);
        const dropdownContent = menu.querySelector('.dropdown-content');

        menu.addEventListener('click', function(event) {
            // Cerrar todos los dropdowns antes de abrir el seleccionado
            menus.forEach(id => {
                const otherMenu = document.getElementById(id);
                const otherDropdownContent = otherMenu.querySelector('.dropdown-content');
                if (id !== menuId) {
                    otherDropdownContent.style.display = 'none';
                }
            });

            // Mostrar/Ocultar dropdown del menú actual
            const isVisible = dropdownContent.style.display === 'block';
            dropdownContent.style.display = isVisible ? 'none' : 'block';
            event.stopPropagation();
        });

        // Ocultar dropdown si se hace clic fuera del menú
        window.addEventListener('click', function(event) {
            if (!event.target.closest(`#${menuId}`)) {
                dropdownContent.style.display = 'none';
            }
        });
    });
});
