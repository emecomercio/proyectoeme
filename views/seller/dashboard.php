<?php

/**
 * @var App\Models\Category [] $categories
 */
$categories = getCategories();
?>
<div class="all-container">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="sidebar">
        <a href="#" class="sidebar-item" data-target="product-display">
            <i class="fas fa-shopping-bag"></i>
        </a>
        <a href="#" class="sidebar-item" data-target="upload_product-display">
        <i class="fa-solid fa-plus"></i>
        </a>
        <a href="#" class="sidebar-item" data-target="stats-display">

            <i class="fas fa-chart-line"></i>
        </a>
        <a href="#" class="sidebar-item" data-target="maps-display">
            <i class="fas fa-truck"></i>
        </a>
        <a href="#" class="sidebar-item" data-target="settings">
            <i class="fas fa-cog"></i>
        </a>
    </div>
    <section class="products-display active" id="product-display">
        <h1>Mis productos</h1>
        <div class="product-dashboard">
        </div>
    </section>

    <section class="upload_product-display" id="upload_product-display">
        <h1>Subir producto</h1>
        <form class="product-upload-form">
    <!-- Primera sección: Crear Producto -->
    <div class="section active" id="create-product">
        <div class="product-parent-section">
                    <label for="parent-product-name">Product Parent Name:</label>
                    <input type="text" id="parent-product-name" name="parent-product-name" placeholder="Enter parent product name">
        </div>
        <label for="category">Select Category</label>
        <select name="category" id="category">
            <!-- Las opciones serán cargadas dinámicamente -->
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
        <div class="description-section">
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            <div id="charCount">0/350</div>
        </div>
        <div class="attributes-section">
                <h3>Product Attributes</h3>
                <div id="attributes-container">
                    <!-- Campos dinámicos para atributos -->
                    <div class="attribute-row">
                        <input type="text" name="attribute_name[]" placeholder="Attribute 1" required>
                    </div>
                </div>
                <!-- Botón para agregar nuevos atributos -->
                <button type="button" id="add-attribute" class="add-attribute-button">Add Attribute</button>
            </div>
                <br>

        <button type="button" id="cancel-step-1">Cancelar</button>
        <button type="button" id="next-step-1">Next</button>
    </div>

    <div class="section" id="add-variants">
    <h3>Add Variants</h3>
    <div class="variant-row">
        <span>Variant 1</span>
        <span class="variant-price">--</span>
        <span class="variant-stock">--</span>
        <button type="button" class="edit-button" data-variant-id="1">Editar</button>
    </div>
    <button id="add-variant-btn">+</button>
    <div class="action-buttons">
        <button type="button" id="cancel-step-2">Cancelar</button>
        <button type="button" id="next-step-2">Next</button>
    </div>
</div>

<!-- Modal para editar -->
<div id="edit-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Variant</h3>
        <label for="modal-price">Price:</label>
        <input type="number" id="modal-price" placeholder="Enter price" required>
        <label for="modal-stock">Stock:</label>
        <input type="number" id="modal-stock" placeholder="Enter stock" required>
        <label for="modal-description">Description:</label>
        <textarea id="modal-description" placeholder="Enter description"></textarea>
        <label for="modal-specs">Specifications:</label>
        <textarea id="modal-specs" placeholder="Enter specifications"></textarea>
        <div id="modal-attributes-container"></div>
        <button type="button" id="save-modal">Save</button>
    </div>
</div>



    <!-- Tercera sección: Cargar Imágenes y Atributos -->
    <div class="section" id="upload-images">
        <h3>Upload Images</h3>
        <label for="images">Cargar imágenes</label>
        <input type="file" name="images" id="images" multiple>
        
        <h3>Atributos</h3>
        <!-- Aquí van los campos de atributos -->
        <button type="button" id="cancel-step-3">Cancelar</button>
        <button type="submit" id="submit-form">Aceptar</button>
    </div>
</form>

    </section>

    <section class="stats-display" id="stats-display">
        <h1>Estadisticas</h1>
        <div class="chart-container">
            <!-- Título y logo -->
            <div class="chart-header">
                <h2>Ventas hasta la Fecha</h2>
            </div>
                <canvas id="myChart"></canvas>
            <div class="chart-legend">
                <div><span class="legend-sales"></span>Ventas a la Fecha</div>
                <div><span class="legend-goal"></span>Meta</div>
                <div><span class="legend-last-year"></span>Año previo</div>
            </div>
        </div>
    </section>

    <section class="settings-display" id="settings">
        <h1>Configuraciones</h1>
        <div class="stats-dashboard">
            <div class="container">
                <div class="settings-section">
                    <h2 class="settings-title">Perfil de Usuario</h2>
                    <form>
                        <label for="name">Nombre completo:</label>
                        <input type="text" id="name" name="name">

                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email">

                        <label for="phone">Número de teléfono:</label>
                        <input type="tel" id="phone" name="phone">

                        <label for="profile-picture">Foto de perfil:</label>
                        <input type="file" id="profile-picture" name="profile-picture">

                        <h3 class="settings-subtitle">Configuración de Contraseña</h3>
                        <label for="current-password">Contraseña actual:</label>
                        <input type="password" id="current-password" name="current-password">

                        <label for="new-password">Nueva contraseña:</label>
                        <input type="password" id="new-password" name="new-password">

                        <button type="submit">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="maps-display" id="maps-display">
        <h1>Oficinas de Correos en Uruguay</h1>
        <label for="correos-dropdown">Oficinas de Correos</label>
        <select id="correos-dropdown">
            <option value="" disabled selected>Seleccione una oficina de correos...</option>
            <option data-target="maps-oficina-montevideo" value="central">Oficina Central (Montevideo)</option>
            <option data-target="maps-oficina-maldonado" value="maldonado">Oficina de Maldonado</option>
            <option data-target="maps-oficina-paysandu" value="paysandu">Oficina de Paysandú</option>
            <option data-target="maps-oficina-salto" value="salto">Oficina de Salto</option>
            <option data-target="maps-oficina-colonia" value="colonia">Oficina de Colonia</option>
            <option data-target="maps-oficina-tacuarembo" value="tacuarembo">Oficina de Tacuarembó</option>
        </select>
        <div id="maps-oficina-montevideo">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13093.247332744659!2d-56.18963884519906!3d-34.87351507433016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x959f80122db8ac2b%3A0x87fa1ff55fb72114!2sCorreo%20Uruguayo!5e0!3m2!1ses!2suy!4v1727935016095!5m2!1ses!2suy" width="600" height="400"></iframe>
        </div>
        <div id="maps-oficina-maldonado">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.0121590625413!2d-54.96154552492642!3d-34.906144373531795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95751a82f969a90d%3A0x5038d6831df77de3!2sCorreo%20Uruguayo%20%7C%20Sucursal%20San%20Fernando%20de%20Maldonado!5e0!3m2!1ses!2suy!4v1727936295507!5m2!1ses!2suy" width="600" height="400"></iframe>
        </div>
        <div id="maps-oficina-paysandu">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3389.379444633099!2d-58.08750191957834!3d-32.3170883896187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95afcbe29bbca2f3%3A0x3629b20ca13a8d03!2sCorreo%20Uruguayo!5e0!3m2!1sen!2suy!4v1727937740152!5m2!1sen!2suy" width="600" height="400"></iframe>
        </div>
        <div id="maps-oficina-salto">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27247.62424743123!2d-57.983755231814925!3d-31.387858599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95addd7f57a6cfc5%3A0xf464fc7798432aff!2sCorreo%20Uruguayo!5e0!3m2!1sen!2suy!4v1727937957935!5m2!1sen!2suy" width="600" height="400"></iframe>
        </div>
        <div id="maps-oficina-colonia">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1684120.1968619295!2d-60.15314090625!3d-34.46998260000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a31267a539b613%3A0x2ad4cecdb2d502b6!2sCorreo%20Uruguayo!5e0!3m2!1sen!2suy!4v1727938035734!5m2!1sen!2suy" width="600" height="400"></iframe>
        </div>
        <div id="maps-oficina-tacuarembo">
            <iframe active src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3394.06607112081!2d-55.9818406250264!3d-31.71409011070497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a84f1d880342c7%3A0x5367bb9248e7d3e8!2sCorreo%20Uruguayo%20Tacuaremb%C3%B3%2C%20Tacuaremb%C3%B3%2C%20Uruguay!5e0!3m2!1sen!2suy!4v1727938112376!5m2!1sen!2suy" width="600" height="400"></iframe>
        </div>
        <div class="correos-dropdown-wrapper">
        </div>
</div>
</div>
</div>

<form action="/api/seller/60/products" id="create-form">
    <input type="hidden" name="seller-id" value="<?= getUser('id') ?>">
    <input type="text" name="name" placeholder="Product Name">
    <input type="text" name="description" placeholder="Product Description">
    <select name="category-id">
        <?php foreach (getCategories() as $category): ?>
            <option value="<?= $category->id ?>"><?= $category->name ?></option>
        <?php endforeach; ?>

    </select>
    <button type="submit">Enviar</button>
</form>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js" async defer></script>