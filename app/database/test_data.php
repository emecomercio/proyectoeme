<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Incluye el autoload de Composer

use Faker\Factory as Faker;
use Faker\Generator;

/**
 * @var PDO $pdo
 * @var Generator $faker
 * @var int $num
 * @var string $role
 * @var string $username
 * @var string $email
 * @var string $document_number
 * @var string $password_hash
 * @var string $fullname
 * @var string $birthdate
 * @var string $address
 * @var string $city
 * @var string $state
 * @var string $country
 * @var string $zip
 * @var string $phone
 * @var string $seller_id
 * @var string $product_name
 * @var string $product_description
 * @var float $product_price
 * @var int $product_stock
 * 
 */

// Desactivar límites de tiempo y de memoria
set_time_limit(0);  // Sin límite de tiempo
ini_set('memory_limit', '-1');  // Sin límite de memoria

// Ajustar tamaños de archivos (si es necesario)
ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');

// Optimizar tiempos de espera de la base de datos
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

// Desactivar el almacenamiento en búfer de salida (opcional)
ob_implicit_flush(true);
ob_end_flush();


$faker = Faker::create(); // Crea una instancia de Faker
$pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', ''); // Configura la conexión PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insertar datos en la tabla users
// function insertUsers(PDO $pdo, Generator $faker, int $num)
// {
//     $stmt = $pdo->prepare("
//         INSERT INTO users (role, username, email, password_hash, document_number) 
//         VALUES (:role, :username, :email, :password_hash, :document_number)
//     ");

//     for ($i = 0; $i < $num; $i++) {
//         $role = $faker->randomElement(['buyer', 'seller', 'admin']);
//         $username = $faker->userName;
//         $email = $faker->email;
//         $document_number = $faker->ssn;
//         $password_hash = password_hash($faker->password, PASSWORD_BCRYPT);

//         $stmt->execute([
//             ':role' => $role,
//             ':username' => $username,
//             ':email' => $email,
//             ':password_hash' => $password_hash,
//             ':document_number' => $document_number
//         ]);
//     }
// }

function insertBuyers(PDO $pdo, Generator $faker, int $num)
{
    $insertUserStmt = $pdo->prepare("
        INSERT INTO users (role, username, email, password_hash, document_number, name) 
        VALUES (:role, :username, :email, :password_hash, :document_number, :name)
    ");

    $insertBuyerStmt = $pdo->prepare("
        INSERT INTO buyers (id, birthdate) 
        VALUES (:id, :birthdate)
    ");

    // Preparar consultas para verificar si el email o el username ya existen
    $checkEmailStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $checkUsernameStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");

    for ($i = 0; $i < $num; $i++) {
        $role = 'buyer';
        $username = $faker->userName;
        $email = $faker->email;
        $name = ucwords($faker->name());
        $password_hash = password_hash($faker->password, PASSWORD_BCRYPT);
        $document_number = $faker->unique()->numberBetween(10000000, 99999999);

        // Verificar si el email ya existe
        $checkEmailStmt->execute([':email' => $email]);
        $emailExists = $checkEmailStmt->fetchColumn();

        // Verificar si el username ya existe
        $checkUsernameStmt->execute([':username' => $username]);
        $usernameExists = $checkUsernameStmt->fetchColumn();

        // Si el email o el username ya existen, generar otros nuevos
        while ($emailExists) {
            $email = $faker->unique()->email;
            $checkEmailStmt->execute([':email' => $email]);
            $emailExists = $checkEmailStmt->fetchColumn();
        }

        while ($usernameExists) {
            $username = $faker->unique()->userName;
            $checkUsernameStmt->execute([':username' => $username]);
            $usernameExists = $checkUsernameStmt->fetchColumn();
        }

        // Insertar el usuario con un email y username únicos
        $insertUserStmt->execute([
            ':role' => $role,
            ':username' => $username,
            ':email' => $email,
            ':name' => $name,
            ':password_hash' => $password_hash,
            ':document_number' => $document_number
        ]);

        // Obtener el ID del usuario insertado
        $userId = $pdo->lastInsertId();

        // Insertar en la tabla buyers usando el ID del usuario
        $birthdate = $faker->date;

        $insertBuyerStmt->execute([
            ':id' => $userId,
            ':birthdate' => $birthdate
        ]);
    }
}


function insertSellers(PDO $pdo, Generator $faker, int $num)
{
    $insertUserStmt = $pdo->prepare("
        INSERT INTO users (role, username, email, password_hash, document_number, name) 
        VALUES (:role, :username, :email, :password_hash, :document_number, :name)
    ");

    $insertSellerStmt = $pdo->prepare("
        INSERT INTO sellers (id, description, website, logo_url, mercadopago_account, paypal_account) 
        VALUES (:id, :description, :website, :logo_url, :mercadopago_account, :paypal_account)
    ");

    // Preparar consultas para verificar si el email o el username ya existen
    $checkEmailStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $checkUsernameStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");

    for ($i = 0; $i < $num; $i++) {
        $role = 'seller';
        $username = $faker->userName;
        $name = ucwords($faker->company);
        $email = $faker->email;
        $password_hash = password_hash($faker->password, PASSWORD_BCRYPT);
        $document_number = $faker->unique()->numberBetween(10000000, 99999999);

        // Verificar si el email ya existe
        $checkEmailStmt->execute([':email' => $email]);
        $emailExists = $checkEmailStmt->fetchColumn();

        // Verificar si el username ya existe
        $checkUsernameStmt->execute([':username' => $username]);
        $usernameExists = $checkUsernameStmt->fetchColumn();

        // Si el email o el username ya existen, generar otros nuevos
        while ($emailExists) {
            $email = $faker->unique()->email;
            $checkEmailStmt->execute([':email' => $email]);
            $emailExists = $checkEmailStmt->fetchColumn();
        }

        while ($usernameExists) {
            $username = $faker->unique()->userName;
            $checkUsernameStmt->execute([':username' => $username]);
            $usernameExists = $checkUsernameStmt->fetchColumn();
        }

        // Insertar el usuario con un email y username únicos
        $insertUserStmt->execute([
            ':role' => $role,
            ':username' => $username,
            ':email' => $email,
            ':name' => $name,
            ':password_hash' => $password_hash,
            ':document_number' => $document_number
        ]);

        // Obtener el ID del usuario insertado
        $userId = $pdo->lastInsertId();
        $description = $faker->text;
        $website = $faker->url;
        $logo_url = $faker->imageUrl;
        $mercadopago_account = $faker->unique()->numberBetween(1000000000, 9999999999);
        $paypal_account = $faker->unique()->numberBetween(1000000000, 9999999999);

        $insertSellerStmt->execute([
            ':id' => $userId,
            ':description' => $description,
            ':website' => $website,
            ':logo_url' => $logo_url,
            ':mercadopago_account' => $mercadopago_account,
            ':paypal_account' => $paypal_account
        ]);
    }
}

function insertPhones(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO phones (user_id, number) 
        VALUES (:user_id, :number)
    ");

    // Obtener IDs de usuarios existentes
    $userIds = $pdo->query('SELECT id FROM users')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $user_id = $faker->randomElement($userIds);
        $number = $faker->phoneNumber;

        $stmt->execute([
            ':user_id' => $user_id,
            ':number' => $number
        ]);
    }
}

function insertAddresses(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO addresses (user_id, street, city, state, postal_code, country, type, description) 
        VALUES (:user_id, :street, :city, :state, :postal_code, :country, :type, :description)
    ");

    // Obtener IDs de usuarios existentes
    $userIds = $pdo->query('SELECT id FROM users')->fetchAll(PDO::FETCH_COLUMN);

    $types = ['home', 'work', 'other'];

    for ($i = 0; $i < $num; $i++) {
        $user_id = $faker->randomElement($userIds);
        $street = $faker->streetAddress;
        $city = $faker->city;
        $state = $faker->state;
        $postal_code = $faker->postcode;
        $country = $faker->country;
        $type = $faker->randomElement($types);
        $description = $faker->optional()->text(100);

        $stmt->execute([
            ':user_id' => $user_id,
            ':street' => $street,
            ':city' => $city,
            ':state' => $state,
            ':postal_code' => $postal_code,
            ':country' => $country,
            ':type' => $type,
            ':description' => $description
        ]);
    }
}

function insertDiscounts(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO discounts (seller_id, name, start_date, end_date, active, type, value, max) 
        VALUES (:seller_id, :name, :start_date, :end_date, :active, :type, :value, :max)
    ");

    // Obtener IDs de vendedores existentes
    $sellerIds = $pdo->query('SELECT id FROM sellers')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $seller_id = $faker->randomElement($sellerIds);
        $name = $faker->word;
        $start_date = $faker->date;
        $end_date = $faker->date;
        $active = $faker->numberBetween(0, 1);
        $type = $faker->numberBetween(0, 1); // 0: porcentaje, 1: fijo
        $value = $type == 0 ? $faker->numberBetween(5, 50) : $faker->randomNumber(); // Valor del descuento
        $max = $faker->optional()->randomNumber(); // Valor máximo del descuento (opcional)

        $stmt->execute([
            ':seller_id' => $seller_id,
            ':name' => $name,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':active' => $active,
            ':type' => $type,
            ':value' => $value,
            ':max' => $max
        ]);
    }
}

// Insertar datos en la tabla catalogs
function insertCatalogs(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO catalogs (discount_id, name) 
        VALUES (:discount_id, :name)
    ");

    // Obtener IDs de descuentos existentes
    $discountIds = $pdo->query('SELECT id FROM discounts')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $discount_id = $faker->optional()->randomElement($discountIds); // Puede ser NULL si no hay descuento asociado
        $name = ucwords($faker->word);

        $stmt->execute([
            ':discount_id' => $discount_id,
            ':name' => $name
        ]);
    }
}

// Insertar datos en la tabla products
function insertProducts(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO products (catalog_id, seller_id, name, description) 
        VALUES (:catalog_id, :seller_id, :name, :description)
    ");

    // Obtener IDs de catálogos y vendedores existentes
    $catalogIds = $pdo->query('SELECT id FROM catalogs')->fetchAll(PDO::FETCH_COLUMN);
    $sellerIds = $pdo->query('SELECT id FROM sellers')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $catalog_id = $faker->randomElement($catalogIds);
        $seller_id = $faker->randomElement($sellerIds);
        $name = ucwords($faker->word);
        $description = $faker->optional()->text(200);

        $stmt->execute([
            ':catalog_id' => $catalog_id,
            ':seller_id' => $seller_id,
            ':name' => $name,
            ':description' => $description
        ]);
    }
}

// Insertar datos en la tabla product_variants
function insertProductVariants(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO product_variants (product_id, discount_id, stock, current_price, last_price) 
        VALUES (:product_id, :discount_id, :stock, :current_price, :last_price)
    ");

    // Obtener IDs de productos y descuentos existentes
    $productIds = $pdo->query('SELECT id FROM products')->fetchAll(PDO::FETCH_COLUMN);
    $discountIds = $pdo->query('SELECT id FROM discounts')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $product_id = $faker->randomElement($productIds);
        $discount_id = $faker->optional()->randomElement($discountIds); // Puede ser NULL si no hay descuento asociado
        $stock = $faker->numberBetween(0, 100);
        $current_price = $faker->randomFloat(2, 5, 500); // Precio actual entre 5 y 500
        $last_price = $faker->optional(0.5, $current_price)->randomFloat(2, 5, 500); // Precio anterior (opcional)

        $stmt->execute([
            ':product_id' => $product_id,
            ':discount_id' => $discount_id,
            ':stock' => $stock,
            ':current_price' => $current_price,
            ':last_price' => $last_price,
        ]);
    }
}

// Insertar datos en la tabla variant_attributes
function insertVariantAttributes($pdo, $faker, $num)
{
    $insertStmt = $pdo->prepare("
        INSERT INTO variant_attributes (variant_id, name, value)
        VALUES (:variant_id, :name, :value)
    ");

    // Consulta para verificar si ya existe el atributo para ese variant_id y name
    $checkStmt = $pdo->prepare("
        SELECT COUNT(*) FROM variant_attributes WHERE variant_id = :variant_id AND name = :name
    ");

    // Obtener todos los IDs de variantes
    $variantIds = $pdo->query("SELECT id FROM product_variants")->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $variant_id = $faker->randomElement($variantIds);
        $name = $faker->word;
        $value = $faker->word;

        // Verificar si ya existe el atributo
        $checkStmt->execute([
            ':variant_id' => $variant_id,
            ':name' => $name
        ]);

        $exists = $checkStmt->fetchColumn();

        // Si ya existe el atributo, generar un nuevo nombre
        while ($exists > 0) {
            $name = $faker->unique()->word;
            $checkStmt->execute([
                ':variant_id' => $variant_id,
                ':name' => $name
            ]);
            $exists = $checkStmt->fetchColumn();
        }

        // Insertar si no existe
        $insertStmt->execute([
            ':variant_id' => $variant_id,
            ':name' => $name,
            ':value' => $value
        ]);
    }
}




// Insertar datos en la tabla images
function insertImages(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO images (variant_id, src, alt_text, width, height) 
        VALUES (:variant_id, :src, :alt_text, :width, :height)
    ");

    // Obtener IDs de variantes de productos existentes
    $variantIds = $pdo->query('SELECT id FROM product_variants')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $variant_id = $faker->randomElement($variantIds);
        $alt_text = $faker->sentence;
        $width = $faker->numberBetween(100, 1920);
        $height = $faker->numberBetween(100, 1080);
        $src =  "https://picsum.photos/" . $width . "/" . $height;

        $stmt->execute([
            ':variant_id' => $variant_id,
            ':src' => $src,
            ':alt_text' => $alt_text,
            ':width' => $width,
            ':height' => $height
        ]);
    }
}

function insertImagesBySize(PDO $pdo, Generator $faker, int $num, array $size = ['width' => 500, 'height' => 500])
{
    $stmt = $pdo->prepare("
        INSERT INTO images (variant_id, src, alt, width, height) 
        VALUES (:variant_id, :src, :alt, :width, :height)
    ");

    // Obtener IDs de variantes de productos existentes
    $variantIds = $pdo->query('SELECT id FROM product_variants')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $variant_id = $faker->randomElement($variantIds);
        $alt_text = $faker->sentence;
        $width = $size['width'];
        $height = $size['height'];
        $src = "https://picsum.photos/" . $width . "/" . $height . "?random=" . rand();

        $stmt->execute([
            ':variant_id' => $variant_id,
            ':src' => $src,
            ':alt' => $alt_text,
            ':width' => $width,
            ':height' => $height
        ]);
    }
}


// Insertar datos en la tabla carts
function insertCarts(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO carts (user_id, total_price, status) 
        VALUES (:user_id, :total_price, :status)
    ");

    // Obtener IDs de usuarios existentes
    $userIds = $pdo->query('SELECT id FROM users')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $user_id = $faker->randomElement($userIds);
        $total_price = $faker->randomFloat(2, 0, 500); // Precio total entre 0 y 500
        $status = $faker->numberBetween(0, 1); // 0: active, 1: completed

        $stmt->execute([
            ':user_id' => $user_id,
            ':total_price' => $total_price,
            ':status' => $status
        ]);
    }
}


// Insertar datos en la tabla cart_lines
function insertCartLines(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO cart_lines (cart_id, variant_id, quantity, price) 
        VALUES (:cart_id, :variant_id, :quantity, :price)
    ");

    // Obtener IDs de carritos y variantes de productos existentes
    $cartIds = $pdo->query('SELECT id FROM carts')->fetchAll(PDO::FETCH_COLUMN);
    $variantIds = $pdo->query('SELECT id FROM product_variants')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $cart_id = $faker->randomElement($cartIds);
        $variant_id = $faker->randomElement($variantIds);
        $quantity = $faker->numberBetween(1, 10);
        $price = $faker->randomFloat(2, 5, 100); // Precio entre 5 y 100

        $stmt->execute([
            ':cart_id' => $cart_id,
            ':variant_id' => $variant_id,
            ':quantity' => $quantity,
            ':price' => $price
        ]);
    }
}

try {
    insertBuyers($pdo, $faker, 50);
    echo "-> Buyers insertados\n";
    insertSellers($pdo, $faker, 50);
    echo "-> Sellers insertados\n";
    insertPhones($pdo, $faker, 110);
    echo "-> Phones insertados\n";
    insertAddresses($pdo, $faker, 110);
    echo "-> Addresses insertados\n";
    insertDiscounts($pdo, $faker, 50);
    echo "-> Discounts insertados\n";
    insertCatalogs($pdo, $faker, 10);
    echo "-> Catalogs insertados\n";
    insertProducts($pdo, $faker, 100);
    echo "-> Products insertados\n";
    insertProductVariants($pdo, $faker, 300);
    echo "-> ProductsVariants  insertados\n";
    insertVariantAttributes($pdo, $faker, 700);
    echo "-> VariantAttributes insertados\n";
    // insertImages($pdo, $faker, 300);
    insertImagesBySize($pdo, $faker, 10000);
    echo "-> Images insertados\n";
    insertCarts($pdo, $faker, 50);
    echo "-> Carts insertados\n";
    insertCartLines($pdo, $faker, 500);
    echo "-> CartLines insertados\n";
    echo "--------------------------------\n";
    echo "|Datos insertados correctamente|\n";
    echo "--------------------------------\n";
} catch (Exception $e) {
    echo "Hubo un error:\n";
    echo $e;
}

// Cierra la conexión a la base de datos
$pdo = null;
