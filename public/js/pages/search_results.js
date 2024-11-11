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

    return result.data;
  } catch (error) {
    console.error("Error:", error.message);
  }
}

const urlParams = new URLSearchParams(window.location.search);
const query = urlParams.get("query");

if (query) {
  let products = await searchQuery(query);
  console.log(products);
} else {
  console.error("No se encontró una búsqueda válida");
}
