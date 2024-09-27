<?php

/** @var array $products
 */
?>
<div class="all-container">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="sidebar">
        <a href="#" class="sidebar-item">
            <i class="fas fa-shopping-bag"></i>
        </a>
        <a href="#" class="sidebar-item">
            <i class="fas fa-chart-line"></i>
        </a>
        <a href="#" class="sidebar-item">
            <i class="fas fa-dollar-sign"></i>
        </a>
        <a href="#" class="sidebar-item">
            <i class="fas fa-user-shield"></i>
        </a>
        <a href="#" class="sidebar-item">
            <i class="fas fa-truck"></i>
        </a>
        <a href="#" class="sidebar-item">
            <i class="fas fa-cog"></i>
        </a>
    </div>
    <section class="products-display">
        <h1>Mis productos</h1>
        <div class="seller-dashboard">

        </div>
    </section>
</div>

<form action="/api/seller/60/products" id="create-form" hidden>
    <input type="hidden" name="seller-id" value="<?= $_SESSION['user']['id'] ?>">
    <input type="text" name="name" placeholder="Product Name">
    <input type="text" name="description" placeholder="Product Description">
    <select name="catalog-id">
        <?php foreach ($catalogs as $catalog): ?>
            <option value="<?= $catalog['id'] ?>"><?= $catalog['name'] ?></option>
        <?php endforeach; ?>

    </select>
    <button type="submit">Enviar</button>
</form>