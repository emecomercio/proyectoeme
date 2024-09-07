<?php

/** @var array $product*/ ?>

<?php
render("products/components/product", ["product" => $product]);
?>

<?php render("products/components/reviews-questions") ?>
<div class="comments-container">
    <?php
    // Temporal
    for ($i = 0; $i < 10; $i++) {
        render("products/components/reviews", ["product" => $product]);
    }
    ?>
</div>