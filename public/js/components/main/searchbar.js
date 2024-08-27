export function searchbar() {
  const searchBar = document.querySelector(".BarraBusqueda");

  if (searchBar) {
    searchBar.addEventListener("focus", function () {
      this.placeholder = ""; // El placeholder desaparece al hacer clic
    });

    searchBar.addEventListener("blur", function () {
      this.placeholder = "Buscar"; // El placeholder regresa cuando se pierde el foco
    });
  }
}
