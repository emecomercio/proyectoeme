const form = document.querySelector(".auth-form");
const password = document.getElementById("password");
const passwordCheck = document.getElementById("password-check");

form.addEventListener("submit", function (event) {
  if (password.value !== passwordCheck.value) {
    alert("Las contraseñas no coinciden.");
    event.preventDefault(); // Evita el envío del formulario
  }
  if (password.value.length < 8) {
    alert("La contraseña debe tener al menos 8 caracteres.");
    event.preventDefault(); // Evita el envío del formulario
  }
});
