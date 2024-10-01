<?php

use Lib\View;
use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\BuyerController;
use App\Controllers\SellerController;
use App\Controllers\CatalogController;
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
    $homeController = new HomeController();
    $homeController->index();
});

// USERS ROUTES
Route::get('/dashboard', function () {
    $userController = new UserController();
    $userController->dashboard();
});

Route::get('/settings', function () {
    $userController = new UserController();
    $userController->settings();
});

Route::get('/login', function () {

    $catalogController = new CatalogController();
    $msg = $_SESSION['msg']['login'] ?? '';
    unset($_SESSION['msg']['login']);
    $login = new View('auth/login');
    $login->data = [
        'title' => 'Login | EME Comercio',
        'msg' => $msg
    ];
    $login->styles = [
        '/css/pages/register-login.css'
    ];
    $login->render();
});

Route::get('/register/{role}', function ($role) {
    $register = new View("auth/$role/register");
    $register->data = [
        'title' => 'Registro | EME Comercio'
    ];
    $register->styles = [
        '/css/pages/register-login.css'
    ];
    $register->render();
});

// BUYERS

Route::get('/cart', function () {
    $productController = new UserController();
    $productController->cart();
});

Route::get('/favorites', function () {
    $buyerController = new BuyerController();
    $buyerController->showFavorites();
});

Route::get('/shopping-history', function () {
    $buyerController = new BuyerController();
    $buyerController->showShopingHistory();
});

Route::get('/search-history', function () {
    $buyerController = new BuyerController();
    $buyerController->showSearchHistory();
});

// SELLERS

Route::get('/store/upload', function () {
    $role = getUserRole();
    $sellerController = new SellerController($role);
    $sellerController->showUploadProduct();
});

Route::get('/store/settings', function () {
    $role = getUserRole();
    $sellerController = new SellerController($role);
    $sellerController->showSettings();
});

// PRODUCTS
Route::get('/product-page/{id}/{variantNumber}', function ($id, $variantNumber) {
    $productController = new ProductController();
    $productController->index($id,  $variantNumber);
});

Route::get('/catalog/{id}', function ($id) {
    $catalogController = new CatalogController();
    $catalogController->index($id);
});

// PRODUCTS ROUTES
Route::get('/result-search-component', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return render('products/components/result-search-component', ['errorMsg' => $errorMsg]);
});
Route::get('/filter-result-search', function () {
    $errorMsg = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
    return render('products/components/filter-result-search', ['errorMsg' => $errorMsg]);
});

// STATIC
Route::get('/terms-and-conditions', function () {
    $homeController = new HomeController();
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
