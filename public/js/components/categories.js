document.addEventListener('DOMContentLoaded', function() {
    const categorias = document.querySelectorAll('.categories');
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const sectionCategories = document.querySelector('.section-categories');

    categorias.forEach(function(categorie) {
        categorie.addEventListener('click', function() {
            const dropdownContent = this.querySelector('.dropdown-content-categories');
            const isVisible = dropdownContent.style.display === 'block';
            document.querySelectorAll('.dropdown-content-categories').forEach(function(content) {
                content.style.display = 'none';
            });
            dropdownContent.style.display = isVisible ? 'none' : 'block';
        });
    });

    window.addEventListener('click', function(event) {
        if (!event.target.closest('.categories')) {
            document.querySelectorAll('.dropdown-content-categories').forEach(function(content) {
                content.style.display = 'none';
            });
        }
    });

    hamburgerMenu.addEventListener('click', function() {
        sectionCategories.style.display = sectionCategories.style.display === 'none' || sectionCategories.style.display === '' ? 'flex' : 'none';
    });
});
