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

    searchQuery(query);
  });
}

async function searchQuery(query) {
  const url = `/api/search?query=${encodeURIComponent(query)}`;

  try {
    const response = await fetch(url);

    if (!response.ok) {
      const errorResponse = await response.json();
      throw new Error(
        errorResponse.message || "Unknown error while performing the search"
      );
    }

    const result = await response.json();

    if (result.status === "error") {
      throw new Error(result.message);
    }

    console.log(result);
  } catch (error) {
    console.error("Error:", error.message);
  }
}
