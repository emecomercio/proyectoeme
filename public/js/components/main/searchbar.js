export function searchbar() {
  const searchInput = document.querySelector(".searchbar");

  searchInput.addEventListener("focus", function () {
    this.placeholder = "";
  });

  searchInput.addEventListener("blur", function () {
    this.placeholder = "Buscar";
  });

  const searchForm = document.querySelector(".searchbar-form");

  searchForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const query = searchInput.value.trim();
    if (!query) {
      alert("Por favor, ingrese una búsqueda");
      return;
    }

    window.location.href = `/search?query=${encodeURIComponent(query)}`;
  });
}
