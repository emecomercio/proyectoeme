<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Incluye el autoload de Composer

use Faker\Factory as Faker;

$faker = Faker::create(); // Crea una instancia de Faker
$pdo = new PDO('mysql:host=localhost;dbname=tienda', 'root', 'root'); // Configura la conexión PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insertar datos en la tabla discounts
$discountsStmt = $pdo->prepare("INSERT INTO discounts (seller_id, name, start_date, end_date, active, type, value, max) VALUES (:seller_id, :name, :start_date, :end_date, :active, :type, :value, :max)");
for ($i = 0; $i < 10; $i++) {
    $discountsStmt->execute([
        ':seller_id' => $faker->numberBetween(11, 15),
        ':name' => $faker->word,
        ':start_date' => $faker->date,
        ':end_date' => $faker->date,
        ':active' => $faker->numberBetween(0, 1),
        ':type' => $faker->numberBetween(0, 1),
        ':value' => $faker->numberBetween(10, 500),
        ':max' => $faker->optional()->numberBetween(1, 100)
    ]);
}

// Insertar datos en la tabla catalogs
$catalogsStmt = $pdo->prepare("INSERT INTO catalogs (discount_id, name) VALUES (:discount_id, :name)");
for ($i = 0; $i < 5; $i++) {
    $catalogsStmt->execute([
        ':discount_id' => $faker->numberBetween(1, 10),
        ':name' => $faker->word
    ]);
}

// Insertar datos en la tabla products
$productsStmt = $pdo->prepare("INSERT INTO products (catalog_id, seller_id, name, description) VALUES (:catalog_id, :seller_id, :name, :description)");
for ($i = 0; $i < 50; $i++) {
    $productsStmt->execute([
        ':catalog_id' => $faker->numberBetween(1, 5),
        ':seller_id' => $faker->numberBetween(11, 15),
        ':name' => $faker->word,
        ':description' => $faker->text
    ]);
}

// Insertar datos en la tabla product_variants
$productVariantsStmt = $pdo->prepare("INSERT INTO product_variants (product_id, discount_id, stock, current_price, last_price, state) VALUES (:product_id, :discount_id, :stock, :current_price, :last_price, :state)");
for ($i = 0; $i < 100; $i++) {
    $productVariantsStmt->execute([
        ':product_id' => $faker->numberBetween(1, 50),
        ':discount_id' => $faker->optional()->numberBetween(1, 10),
        ':stock' => $faker->numberBetween(1, 100),
        ':current_price' => $faker->randomFloat(2, 1, 100),
        ':last_price' => $faker->optional()->randomFloat(2, 1, 100),
        ':state' => $faker->numberBetween(0, 1)
    ]);
}

// Insertar datos en la tabla variant_attributes
$variantAttributesStmt = $pdo->prepare("INSERT INTO variant_attributes (variant_id, name, value) VALUES (:variant_id, :name, :value)");
for ($i = 0; $i < 200; $i++) {
    $variantAttributesStmt->execute([
        ':variant_id' => $faker->numberBetween(1, 100),
        ':name' => $faker->word,
        ':value' => $faker->word
    ]);
}

// Insertar datos en la tabla images
$imagesStmt = $pdo->prepare("INSERT INTO images (variant_id, image_url, alt_text, width, height) VALUES (:variant_id, :image_url, :alt_text, :width, :height)");
for ($i = 0; $i < 100; $i++) {
    $imageUrl = 'https://picsum.photos/200/300?random=' . rand(1, 1000);
    $imagesStmt->execute([
        ':variant_id' => $faker->numberBetween(1, 100),
        ':image_url' => $imageUrl,
        ':alt_text' => $faker->word,
        ':width' => 800,
        ':height' => 600
    ]);
}

// Insertar datos en la tabla carts
$cartsStmt = $pdo->prepare("INSERT INTO carts (user_id, total_price, status) VALUES (:user_id, :total_price, :status)");
for ($i = 0; $i < 50; $i++) {
    $cartsStmt->execute([
        ':user_id' => $faker->numberBetween(1, 10),
        ':total_price' => $faker->randomFloat(2, 10, 500),
        ':status' => $faker->numberBetween(0, 1)
    ]);
}

// Insertar datos en la tabla cart_lines
$cartLinesStmt = $pdo->prepare("INSERT INTO cart_lines (cart_id, variant_id, quantity) VALUES (:cart_id, :variant_id, :quantity)");

for ($i = 0; $i < 200; $i++) {
    try {
        $cartLinesStmt->execute([
            ':cart_id' => $faker->numberBetween(1, 50),
            ':variant_id' => $faker->numberBetween(1, 100),
            ':quantity' => $faker->numberBetween(1, 5)
        ]);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage() . "\n";
    }
}

echo "Datos de prueba generados exitosamente.";

$pdo = null; // Cierra la conexión
