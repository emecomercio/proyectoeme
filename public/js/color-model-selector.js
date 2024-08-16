document.querySelectorAll('.model').forEach(model => {
    model.addEventListener('click', function() {
        document.querySelectorAll('.model').forEach(m => m.classList.remove('selected'));
        this.classList.add('selected');
    });
});

document.querySelectorAll('.color').forEach(color => {
    color.addEventListener('click', function() {
        document.querySelectorAll('.color').forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');
    });
});
