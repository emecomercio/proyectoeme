// Mostrar el dropdown y guardar el estado en localStorage
function show() {
    document.getElementById('user-dropdown').style.display = 'block';
    document.getElementById('register-login').style.display = 'none';
    document.getElementById('shopping').style.display = 'block';
    localStorage.setItem('dropdownVisible', 'true');
}

// Ocultar el dropdown y guardar el estado en localStorage
function hide() {
    document.getElementById('user-dropdown').style.display = 'none';
    document.getElementById('register-login').style.display = 'block';
    document.getElementById('shopping').style.display = 'none';
    localStorage.setItem('dropdownVisible', 'false');
}

// Comprobar el estado guardado en localStorage al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const dropdownVisible = localStorage.getItem('dropdownVisible');
    if (dropdownVisible === 'true') {
        document.getElementById('user-dropdown').style.display = 'block';
        document.getElementById('register-login').style.display = 'none';
        document.getElementById('shopping').style.display = 'block';
    } else {
        document.getElementById('user-dropdown').style.display = 'none';
        document.getElementById('register-login').style.display = 'block';
        document.getElementById('shopping').style.display = 'none';
    }
});
