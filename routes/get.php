<?php
require_once CONTROLLERS . "ProductController.php";
require_once CONTROLLERS . "UserController.php";

// Define una ruta GET y ejecuta una funcion (bloque de codigo) cualquiera 
Route::get('/', function () {
    $products = ProductController::getProductsForHomepage();
    view("homepage", [
        "products" => $products
    ]);
});

Route::get('/product-page', function () {
    $product = ProductController::getProductById(1);
    view("product-page", [
        "product" => $product
    ]);
});

// Define una ruta GET con parametros y ejecuta una funcion (bloque de codigo) cualquiera que puede pasarsele parametros 
Route::get('/users/{id}', function ($id) {
    return "User with id: " . $id;
});

// Define una ruta GET que ejecuta un controlador y su metodo correspondiente
Route::get('/dashboard', function () {
    UserController::getUsers();
});


Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/cart', function () {
    return view('cart');
});
// Route::get('/forgot', function () {
//     return view('forgot');
// });
// Route::get('/reset', function () {
//     return view('reset');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
// Route::get('/profile', function () {
//     return view('profile');
// });
// Route::get('/settings', function () {
//     return view('settings');
// });
// Route::get('/tables', function () {
//     return view('tables');
// });
