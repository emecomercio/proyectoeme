<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir producto empresa</title>
</head>

<body>
    <div class="upload-prduct-all">
        <div class="upload-product">
            <h2>Artículo en venta</h2>
            <?= $_SESSION['user_name'] ?? "Usuario" ?>
            <h3>Nuevo producto</h3>
            <input type="text" placeholder="Título">
            <input type="number" placeholder="$00">
            <section>
                <div class="upload-product-dropdown-container">
                    <input type="text" class="dropdown-trigger" placeholder="Selecciona una categoría" readonly>
                    <ul class="dropdown-menu">
                        <li>Categoria 1</li>
                        <li>Categoria 2</li>
                        <li>Categoria 3</li>
                        <li>Categoria 4</li>
                        <li>Categoria 5</li>
                    </ul>
                </div>
                <div class="upload-product-dropdown-container">
                    <input type="text" class="dropdown-trigger" placeholder="Selecciona condición" readonly>
                    <ul class="dropdown-menu">
                        <li>Nuevo</li>
                        <li>Usado</li>
                        <li>Usado como nuevo</li>
                    </ul>
                </div>
            </section>
            <p>Proporciona una descripción que sea lo más detallada posible.</p>
            <textarea id="description" placeholder="Descripcion" oninput="autoExpand(this)"></textarea>
        </div>

        <div class="upload-product-main">
            <p id="imageCounter">Fotos 0/5 <br> Puedes agregar un máximo de 5 fotos en formato .png o .jpeg <br> un maximo de 5MB por imagen</p>
            <button>Publicar</button>
            <input type="file" id="imageInput" multiple accept="image/png, image/jpeg">
            <div class="preview-container">
                <section class="preview">
                    <div id="imagePreview"></div>
                </section>
            </div>
        </div>





</body>

</html>