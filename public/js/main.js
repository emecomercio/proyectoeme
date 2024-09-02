import { searchbar } from "./components/main/searchbar.js";
import { userButton } from "./components/main/user_button.js";

searchbar();
userButton();

function show() {
  document.getElementById("user-dropdown").style.display = "block";
  document.getElementById("register-login").style.display = "none";
  document.getElementById("shopping").style.display = "block";
  localStorage.setItem("dropdownVisible", "true");
}

// Ocultar el dropdown y guardar el estado en localStorage
function hide() {
  document.getElementById("user-dropdown").style.display = "none";
  document.getElementById("register-login").style.display = "block";
  document.getElementById("shopping").style.display = "none";
  localStorage.setItem("dropdownVisible", "false");
}

// Comprobar el estado guardado en localStorage al cargar la página
document.addEventListener("DOMContentLoaded", function () {
  const dropdownVisible = localStorage.getItem("dropdownVisible");
  if (dropdownVisible === "true") {
    hide();
  } else {
    show();
  }
});
