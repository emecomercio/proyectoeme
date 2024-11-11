<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Incluye el autoload de Composer
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

use Faker\Factory as Faker;
use Faker\Generator;

use App\Factories\CategoryFactory;


CategoryFactory::setProperties();

/**
 * @var PDO $pdo
 * @var Generator $faker
 * @var int $num
 * @var string $role
 * @var string $username
 * @var string $email
 * @var string $document_number
 * @var string $password
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

$faker = Faker::create(); // Crea una instancia de Faker
$pdo = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_ROOT']); // Configura la conexión PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insertar datos en la tabla users
// function insertUsers(PDO $pdo, Generator $faker, int $num)
// {
//     $stmt = $pdo->prepare("
//         INSERT INTO users (role, username, email, password, document_number) 
//         VALUES (:role, :username, :email, :password, :document_number)
//     ");

//     for ($i = 0; $i < $num; $i++) {
//         $role = $faker->randomElement(['buyer', 'seller', 'admin']);
//         $username = $faker->userName;
//         $email = $faker->email;
//         $document_number = $faker->ssn;
//         $password = password($faker->password, PASSWORD_BCRYPT);

//         $stmt->execute([
//             ':role' => $role,
//             ':username' => $username,
//             ':email' => $email,
//             ':password' => $password,
//             ':document_number' => $document_number
//         ]);
//     }
// }

function insertBuyers(PDO $pdo, Generator $faker, int $num)
{
    $insertUserStmt = $pdo->prepare("
        INSERT INTO users (role, username, email, password, document_number, name) 
        VALUES (:role, :username, :email, :password, :document_number, :name)
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
        $password = password_hash($faker->password, PASSWORD_BCRYPT);
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
            ':password' => $password,
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
        INSERT INTO users (role, username, email, password, document_number, name) 
        VALUES (:role, :username, :email, :password, :document_number, :name)
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
        $password = password_hash($faker->password, PASSWORD_BCRYPT);
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
            ':password' => $password,
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

function insertProductsAndVariantsWithAttributes(PDO $pdo, Generator $faker, int $numProducts)
{
    // Preparar la consulta para insertar productos
    $insertProductStmt = $pdo->prepare("
        INSERT INTO products (category_id, seller_id, name, description) 
        VALUES (:category_id, :seller_id, :name, :description)
    ");

    // Preparar la consulta para insertar variantes
    $insertVariantStmt = $pdo->prepare("
        INSERT INTO product_variants (product_id, discount_id, stock, current_price, last_price) 
        VALUES (:product_id, :discount_id, :stock, :current_price, :last_price)
    ");

    // Preparar la consulta para insertar atributos de variantes
    $insertAttributeStmt = $pdo->prepare("
        INSERT INTO variant_attributes (variant_id, name, value)
        VALUES (:variant_id, :name, :value)
    ");

    // Obtener IDs de categorías, vendedores y descuentos existentes
    $categoryIds = $pdo->query('SELECT id FROM categories')->fetchAll(PDO::FETCH_COLUMN);
    $sellerIds = $pdo->query('SELECT id FROM sellers')->fetchAll(PDO::FETCH_COLUMN);
    $discountIds = $pdo->query('SELECT id FROM discounts')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $numProducts; $i++) {
        // Insertar el producto
        $category_id = $faker->randomElement($categoryIds);
        $seller_id = $faker->randomElement($sellerIds);
        $name = ucwords($faker->word);
        $description = $faker->optional()->text(200);

        $insertProductStmt->execute([
            ':category_id' => $category_id,
            ':seller_id' => $seller_id,
            ':name' => $name,
            ':description' => $description
        ]);

        // Obtener el ID del producto recién insertado
        $product_id = $pdo->lastInsertId();

        // Generar entre 2 y 5 variantes para el producto
        $numVariants = $faker->numberBetween(3, 10);
        $variantIds = [];
        for ($j = 0; $j < $numVariants; $j++) {
            $discount_id = $faker->optional()->randomElement($discountIds); // Puede ser NULL si no hay descuento asociado
            $stock = $faker->numberBetween(0, 100);
            $current_price = $faker->randomFloat(2, 5, 500); // Precio actual entre 5 y 500
            $last_price = $faker->optional(0.5, $current_price)->randomFloat(2, 5, 500); // Precio anterior (opcional)

            // Insertar la variante
            $insertVariantStmt->execute([
                ':product_id' => $product_id,
                ':discount_id' => $discount_id,
                ':stock' => $stock,
                ':current_price' => $current_price,
                ':last_price' => $last_price,
            ]);

            // Obtener el ID de la variante recién insertada
            $variantIds[] = $pdo->lastInsertId();
        }

        // Generar entre 2 y 5 nombres de atributos únicos a nivel de producto
        $attributeNames = [];
        $numAttributes = min(5, $numVariants); // Máximo de 5 nombres de atributos por producto
        for ($k = 0; $k < $numAttributes; $k++) {
            $name = $faker->unique()->word; // Generar un nombre de atributo único para el producto
            $attributeNames[] = $name;
        }

        // Para cada variante, asignar valores a cada uno de los atributos definidos
        foreach ($variantIds as $variant_id) {
            foreach ($attributeNames as $name) {
                // Generar un valor único para cada atributo
                $value = $faker->word;

                // Insertar el atributo para la variante
                $insertAttributeStmt->execute([
                    ':variant_id' => $variant_id,
                    ':name' => $name,
                    ':value' => $value
                ]);
            }
        }

        // Restablecer el generador de palabras únicas para el próximo producto
        $faker->unique(true);
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

function insertImagesBySize(PDO $pdo, Generator $faker, int $num)
{
    $stmt = $pdo->prepare("
        INSERT INTO images (variant_id, src, alt) 
        VALUES (:variant_id, :src, :alt)
    ");

    // Obtener IDs de variantes de productos existentes
    $variantIds = $pdo->query('SELECT id FROM product_variants')->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i < $num; $i++) {
        $variant_id = $faker->randomElement($variantIds);
        $alt_text = $faker->sentence;
        $src = "https://picsum.photos/500?random=" . rand(1, 1000);

        $stmt->execute([
            ':variant_id' => $variant_id,
            ':src' => $src,
            ':alt' => $alt_text,
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
    echo "\033[32m-> Buyers inserted\033[0m\n";
    insertSellers($pdo, $faker, 50);
    echo "\033[32m-> Sellers inserted\033[0m\n";
    insertPhones($pdo, $faker, 110);
    echo "\033[32m-> Phones inserted\033[0m\n";
    insertAddresses($pdo, $faker, 110);
    echo "\033[32m-> Addresses inserted\033[0m\n";
    insertDiscounts($pdo, $faker, 50);
    echo "\033[32m-> Discounts inserted\033[0m\n";
    CategoryFactory::createCategories();
    echo "\033[32m-> Categories inserted\033[0m\n";
    insertProductsAndVariantsWithAttributes($pdo, $faker, 100);
    echo "\033[32m-> Products inserted\033[0m\n";
    // insertProductVariants($pdo, $faker, 700);
    // echo "\033[32m-> ProductVariants inserted\033[0m\n";
    // insertVariantAttributes($pdo, $faker, 1000);
    // echo "\033[32m-> VariantAttributes inserted\033[0m\n";
    // insertImages($pdo, $faker, 300);
    insertImagesBySize($pdo, $faker, 2000);
    echo "\033[32m-> Images inserted\033[0m\n";
    // insertCarts($pdo, $faker, 50);
    // echo "\033[32m-> Carts inserted\033[0m\n";
    // insertCartLines($pdo, $faker, 500);
    // echo "\033[32m-> CartLines inserted\033[0m\n";
    echo "\033[32m----------------------------\033[0m\n";
    echo "\033[32m|Data inserted successfully|\033[0m\n";
    echo "\033[32m----------------------------\033[0m\n";
} catch (Exception $e) {
    echo "Hubo un error:\n";
    echo $e;
}

// Cierra la conexión a la base de datos
$pdo = null;
