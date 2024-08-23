document.addEventListener('DOMContentLoaded', function() {
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const menu = this.nextElementSibling;
            const isVisible = menu.style.display === 'block';
            dropdownMenus.forEach(m => m.style.display = 'none'); // Oculta todos los dropdowns
            menu.style.display = isVisible ? 'none' : 'block'; // Alterna la visibilidad
        });
    });

    window.addEventListener('click', function(event) {
        if (!event.target.closest('.upload-product-dropdown-container')) {
            dropdownMenus.forEach(menu => menu.style.display = 'none');
        }
    });

    dropdownMenus.forEach(menu => {
        menu.addEventListener('click', function(event) {
            if (event.target.tagName === 'LI') {
                const trigger = this.previousElementSibling;
                trigger.value = event.target.textContent; // Establece el valor del trigger
                this.style.display = 'none'; // Oculta el dropdown
            }
        });
    });
});

