<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir producto empresa</title>
</head>

<body>
    <form action="">
        <div class="upload-prduct-all">

            <div class="upload-product">
                <h2>Artículo en venta</h2>
                <?= $_SESSION['user_name'] ?? "Usuario" ?>
                <h3>Nuevo producto</h3>
                <input type="text" name="product-title" placeholder="Título" required>
                <input type="number" name="product-price" placeholder="$00" required>
                <section>
                    <div class="upload-product-dropdown-container">
                        <input type="text" class="dropdown-trigger" name="product-category" placeholder="Selecciona una categoría" required>
                        <ul class="dropdown-menu">
                            <li>Categoria 1</li>
                            <li>Categoria 2</li>
                            <li>Categoria 3</li>
                            <li>Categoria 4</li>
                            <li>Categoria 5</li>
                        </ul>
                    </div>
                    <div class="upload-product-dropdown-container">
                        <input type="text" class="dropdown-trigger" name="product-state" placeholder="Selecciona condición" required>
                        <ul class="dropdown-menu">
                            <li>Nuevo</li>
                            <li>Usado</li>
                            <li>Usado como nuevo</li>
                        </ul>
                    </div>
                    <div class="upload-product-dropdown-container">
                        <input type="text" class="dropdown-trigger" name="product-stock" placeholder="Stock" required>
                        <ul class="dropdown-menu">
                            <li>Unica</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>6</li>
                            <li>7</li>
                            <li>+8</li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="upload-product-main">
                <p id="imageCounter">Fotos 0/5 <br> Puedes agregar un máximo de 5 fotos en formato .png o .jpeg <br> un maximo de 5MB por imagen</p>
                <button type="submit">Publicar</button>
                <input type="file" id="imageInput" name="product-images" multiple accept="image/png, image/jpeg" required>
                <div class="preview-container">
                    <section class="preview">
                        <div id="imagePreview"></div>
                    </section>
                </div>
            </div>
        </div>

        <div class="description-container">
            <h1>Descripción</h1>
            <p>Proporciona una descripción que sea lo más detallada posible.</p>
            <textarea id="description" name="product-description" placeholder="       Inserte descripción del producto" oninput="autoExpand(this)" required></textarea>

        </div>

    </form>
</body>

</html>