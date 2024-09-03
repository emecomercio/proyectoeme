<h1><?= $name ?? 'Name' ?></h1>

<section class="recommended-grid">



    <?php

    use Faker\Factory as Faker;

    $faker = Faker::create();
    for ($i = 0; $i < 5; $i++) {
        // logica para instanciar un producto recomendado (llamada a algun controlador incluida)
        // ej:
        // $productController = new ProductController;
        $exampleImage = [
            'src' => 'https://picsum.photos/200/300?random=' . rand(1, 1000),
            'alt' => 'Product Image'
        ];
        $exampleProduct = [
            'name' =>  $faker->name(),
            'price' => $faker->numberBetween(1, 10),
            'image' => $exampleImage
        ];
        $product = /* $productController->getRecommendedProduct()*/ $exampleProduct;

        renderComponent('products/components/recommended', $product);
    }
    ?>
</section>

<!-- Temporal, de prueba -->
<style>
    .recommended-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 0 20px;
        box-sizing: border-box;
        max-width: 100%;

    }

    article {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 1px solid black;
        padding: 10px;
    }

    article>img {
        max-width: 100%;
        height: auto;
    }
</style>