<?php
require_once CONTROLLERS . "ProductController.php";
require_once CONTROLLERS . "UserController.php";

Route::get('/', function () {
    $products = ProductController::getProductsForHomepage();
    view("homepage", [
        "products" => $products
    ]);
});

// USERS ROUTES
Route::get('/dashboard', function () {
    UserController::getUserDashboard();
});

Route::get('/register-user', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return view('auth/register-user', ['errorMsg' => $errorMsg]);
});

Route::get('/login-user', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return view('auth/login-user', ['errorMsg' => $errorMsg]);
});
Route::get('/logout', function () {
    UserController::logout();
});

// PRODUCTS ROUTES
Route::get('/product-page/{id}', function ($id) {
    $product = ProductController::getProductById($id);
    view("products/product-page", [
        "product" => $product
    ]);
});

// TESTING ROUTES
Route::get('/secret-access-to-users', function () {
    UserController::getUsers();
});

// Varias rutas - Pendiente agrupar
Route::get('/register', function () {
    return view('register');
});
Route::get('/cart', function () {
    return view('user/cart');
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
