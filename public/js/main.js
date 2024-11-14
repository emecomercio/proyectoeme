import { searchbar } from "./components/main/searchbar.js";
import { userButton } from "./components/main/user_button.js";
import { createModal, showModal, closeModal } from "./components/main/modal.js";

window.createModal = createModal;
window.showModal = showModal;
window.closeModal = closeModal;

if (document.querySelector(".searchbar")) searchbar();

userButton();
i18next.use(i18nextHttpBackend).init(
  {
    lng: "es", // Idioma predeterminado
    backend: {
      loadPath: "/config/{{lng}}.json", // Ruta donde se encuentran los archivos de traducción
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
let flag = document.querySelector(".language-toggle");
if (localStorage.getItem("language") == "es") {
  flag.classList.add("toggle");
} else {
  flag.classList.remove("toggle");
}

flag.addEventListener("click", function () {
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

let dropdown = document.getElementById("categoriesDropdown");
let dropdownContent = document.getElementById("categoriesMenu");

if (dropdown) {
  dropdown.addEventListener("click", function (e) {
    e.preventDefault();
    dropdownContent.classList.toggle("show");
  });

  window.addEventListener("click", function (e) {
    if (!dropdown.contains(e.target)) {
      dropdownContent.classList.remove("show");
    }
  });
}
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
