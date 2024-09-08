<div class="product-grid">
    <?php
    if (isset($products[0])) {
        foreach ($products as $product) {
            render('products/components/product-card', ['product' => $product]);
        }
    } else {
        echo "Categoria vacia o inexistente";
    }
    ?>
</div>