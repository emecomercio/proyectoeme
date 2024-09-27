<?php

/** @var array $products
 */
?>
<div class="all-container">
    <?php render("seller/components/lateral-slayer") ?>
    <?php render("seller/components/home-entrepise-component") ?>
</div>
<!-- 
<form action="/api/seller/60/products" id="create-form">
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
<script src="/js/pages/seller_dashboard.js"></script>

-->