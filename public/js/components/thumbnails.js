const mainImage = document.getElementById('main-product-image');
const thumbnails = document.querySelectorAll('.thumbnail-image');

thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        mainImage.src = this.src;
    });
});

mainImage.addEventListener('click', function() {
    this.classList.toggle('zoomed');
    this.style.transform = this.classList.contains('zoomed') ? 'scale(2)' : 'scale(1)';
    this.style.transition = 'transform 0.3s ease';
});
