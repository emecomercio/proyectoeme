import { searchbar } from "./components/main/searchbar.js";
import { userButton } from "./components/main/user_button.js";
import { createModal, showModal, closeModal } from "./components/main/modal.js";

window.createModal = createModal;
window.showModal = showModal;
window.closeModal = closeModal;

if (document.querySelector(".searchbar")) searchbar();

userButton();
document.addEventListener("DOMContentLoaded", function () {
  // Inicializa i18next con el idioma predeterminado y carga las traducciones
  i18next.use(i18nextHttpBackend).init(
    {
      lng: "es", // Idioma predeterminado
      backend: {
        loadPath: "../../../config/{{lng}}.json", // Ruta donde se encuentran los archivos de traducción
      },
    },
    function (err, t) {
      updateContent();
    }
  );

  // Carga el idioma almacenado en localStorage al iniciar
  const savedLanguage = localStorage.getItem("language") || "es";
  i18next.changeLanguage(savedLanguage, (err, t) => {
    updateContent();
  });

  // Evento para el contenedor de banderas
  document
    .querySelector(".language-toggle")
    .addEventListener("click", function () {
      this.classList.toggle("toggle");

      // Verifica el idioma actual y cambia al opuesto
      const currentLanguage = i18next.language;
      const newLanguage = currentLanguage === "en" ? "es" : "en";

      // Cambia el idioma en i18next y guarda en localStorage
      i18next.changeLanguage(newLanguage, (err, t) => {
        if (err) return console.error("Error al cambiar el idioma:", err);
        localStorage.setItem("language", newLanguage);
        updateContent();
      });
    });

  // Actualiza el contenido en función del idioma seleccionado
  function updateContent() {
    // Actualizar elementos con data-translate
    const translateElements = document.querySelectorAll("[data-translate]");
    translateElements.forEach((element) => {
      const key = element.getAttribute("data-translate");
      element.textContent = i18next.t(key);

      // Si el elemento tiene un placeholder, traducirlo también
      if (element.placeholder) {
        element.placeholder = i18next.t(key);
      }
    });
  }
});


var dropdown = document.getElementById("categoriesDropdown");
var dropdownContent = document.getElementById("categoriesMenu");

dropdown.addEventListener("click", function (e) {
  e.preventDefault();
  dropdownContent.classList.toggle("show");
});

window.addEventListener("click", function (e) {
  if (!dropdown.contains(e.target)) {
    dropdownContent.classList.remove("show");
  }
});
// LOGOUT FORM
let logout = document.getElementById("logout-btn");
if (logout) {
  logout.addEventListener("click", () => {
    localStorage.removeItem("user");
    fetch("/api/logout", {
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status === "success") {
          window.location.href = "/login";
        } else {
          const [modal, okBtn, badBtn] = createModal(
            "Error Iniciando Sesion",
            data.message
          );
          showModal(modal);
        }
      });
  });
}

localStorage.setItem("uploadsDir", "/uploads");


  const hamburgerMenu = document.getElementById('hamburger-menu');
  const sidebar = document.querySelector('.sidebar');

  hamburgerMenu.addEventListener('click', function () {
    sidebar.classList.toggle('hidden');
  });
