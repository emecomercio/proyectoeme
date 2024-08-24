<?php



use Lib\Route;
use App\Controllers\UserController;
use App\Controllers\ProductController;



Route::get('/api', function () {
    return view('prueba');
});

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

Route::get('/settings', function(){
    view('settings');
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

// ENTERPRISE ROUTES

Route::get('/register-enterprise', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return view('auth/register-enterprise', ['errorMsg' => $errorMsg]);
});
Route::get('/login-enterprise', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return view('auth/login-enterprise', ['errorMsg' => $errorMsg]);
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
    UserController::all();
});

// Varias rutas - Pendiente agrupar
Route::get('/register', function () {
    return view('register');
});
Route::get('/cart', function () {
    return view('user/cart');
});
Route::get('/terms-and-conditions', function () {
    return view('static/terms-and-conditions');
});

Route::get('/homepage', function () {
    return view('components/homepage');
});
Route::get('/shopping', function () {
    return view('/shopping');
});
Route::get('/history', function () {
    return view('/history');
});
Route::get('/favorites', function () {
    return view('/favorites');
});
Route::get('/forgot-password', function () {
    return view('/forgot-password');
});

Route::get('/upload-product-page', function () {
    return view('/upload-product-page');
});
