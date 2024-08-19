document.getElementById('RegisterButton').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    var button = this;
    var newText = 'Registrado correctamente';
    button.textContent = ''; // Vacía el contenido del botón

    // Añade cada letra con un pequeño retraso, incluyendo los espacios
    newText.split('').forEach(function(letter, index) {
        var span = document.createElement('span');
        span.textContent = letter === ' ' ? '\u00A0' : letter; // Asegura que el espacio se muestre correctamente
        span.classList.add('fade-in-letter');
        span.style.animationDelay = (index * 0.01) + 's'; // Añade un retraso entre cada letra
        button.appendChild(span);
    });
});
