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

Route::get('/product-page/{id}', function ($id) {
    $product = ProductController::getProductById($id);
    view("products/product-page", [
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
    return view('products/cart');
});
Route::get('/login-user', function () {
    return view('auth/login-user');
});
Route::get('/register-user', function () {
    return view('auth/register-user');
});
Route::get('/terms-and-conditions', function () {
    return view('static/terms-and-conditions');
});
Route::get('/register-enterprise', function () {
    return view('auth/register-enterprise');
});
Route::get('/login-entrepise', function () {
    return view('auth/login-enterprise');
});
Route::get('/homepage', function () {
    return view('components/homepage');
});
