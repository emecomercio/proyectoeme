export function uploadProduct(product) {
  // pasar los datos del product a formData
  const formData = new FormData();
  formData.append("name", product.name);
  formData.append("description", product.description);
  formData.append("categoryId", product.categoryId);

  product.variants.forEach((variant, variantIndex) => {
    formData.append(`variants[${variantIndex}][price]`, variant.price);
    formData.append(`variants[${variantIndex}][stock]`, variant.stock);

    formData.append(
      `variants[${variantIndex}][attributes]`,
      JSON.stringify(variant.attributes)
    );

    variant.images.forEach((image, imageIndex) => {
      formData.append(
        `variants[${variantIndex}][alt][${imageIndex}]`,
        image.alt
      );

      formData.append(`images[${variantIndex}][${imageIndex}]`, image.file);
    });
  });

  fetch("/api/products", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((result) => {
      console.log("Resultado de Fetch");
      console.log(result);
      if (result.status == "success") {
        alert(
          "Producto creado con éxito (proximamente se reiniciaran los datos ingresados)..."
        );
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
