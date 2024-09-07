<?php

use Lib\View;
use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\BuyerController;
use App\Controllers\ProductController;

Route::get('/vista', function () {
    $vista = new View('products/show');
    $vista->data = [
        'name' => 'Juan',
        'age' => 30
    ];
    $vista->render();
});

Route::get('/api', function () {
    return render('prueba');
});

Route::get('/', function () {
    $role = getUserRole();
    $homeController = new HomeController($role);
    $homeController->index();
});

// USERS ROUTES
Route::get('/dashboard', function () {
    $role = getUserRole();
    $userController = new UserController($role);
    $userController->dashboard();
});

Route::get('/settings', function () {
    $role = getUserRole();
    $userController = new UserController($role);
    $userController->settings();
});

Route::get('/login', function () {
    $msg = $_SESSION['msg']['login'] ?? '';
    unset($_SESSION['msg']['login']);
    $login = new View('auth/login', 'alter/guest');
    $login->data = [
        'title' => 'Login | EME Comercio',
        'msg' => $msg
    ];
    $login->styles = [
        'pages/register-login'
    ];
    $login->render();
});

Route::get('/register/{role}', function ($role) {
    $register = new View("auth/$role/register", 'alter/guest');
    $register->data = [
        'title' => 'Registro | EME Comercio'
    ];
    $register->styles = [
        'pages/register-login'
    ];
    $register->render();
});

// BUYERS

Route::get('/cart', function () {
    $role = getUserRole();
    $productController = new UserController($role);
    $productController->cart();
});

Route::get('/favorites', function () {
    $role = getUserRole();
    $buyerController = new BuyerController($role);
    $buyerController->showFavorites();
});

Route::get('/shopping-history', function () {
    $role = getUserRole();
    $buyerController = new BuyerController($role);
    $buyerController->showShopingHistory();
});

Route::get('/search-history', function () {
    $role = getUserRole();
    $buyerController = new BuyerController($role);
    $buyerController->showSearchHistory();
});

// PRODUCTS

Route::get('/product-page/{id}', function ($id) {
    $role = getUserRole();
    $productController = new ProductController($role);
    $productController->index($id);
});

// ENTERPRISE ROUTES

Route::get('/register-enterprise', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return render('auth/register-enterprise', ['errorMsg' => $errorMsg]);
});
Route::get('/login-enterprise', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return render('auth/login-enterprise', ['errorMsg' => $errorMsg]);
});

// PRODUCTS ROUTES

// STATIC
Route::get('/terms-and-conditions', function () {
    $role = getUserRole();
    $homeController = new HomeController($role);
    $homeController->termsAndConditions();
});

// ERROR

Route::get('/unknown-error', function () {
    return render('errors/unknown');
});

// TESTING ROUTES
Route::get('/test/users', function () {
    // UserController::usersTable();
});

// Varias rutas - Pendiente agrupar
Route::get('/register', function () {
    return render('register');
});

Route::get('/history', function () {
    return render('/history');
});

Route::get('/forgot-password', function () {
    return render('/forgot-password');
});

Route::get('/upload-product-page', function () {
    return render('/upload-product-page');
});
