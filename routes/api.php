<?php

use Lib\Route;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\ProductController;
use App\Api\Controllers\SellerController;

Route::get('/pruebita', function () {
    $roles = json_decode($_ENV['DB_USERS'], true);
    var_dump($roles['admin']);
});

// AUTH

Route::post('/api/login', function () {
    $auth = new AuthController('admin');
    $auth->login();
});

Route::post('/api/register', function () {
    $authController = new AuthController();
    $authController->create();
});

// USERS

Route::get('/api/users', function () {
    $users = new UserController();
    // Llama al método 'index' en el controlador
    $users->index();
});

Route::get('/api/users/{id}', function ($id) {
    $user = new UserController();
    $user->find($id);
});


// PRODUCTS

Route::get('/api/products', function () {
    $products = new ProductController();

    $products->index();
});

Route::get('/api/products/{id}', function ($id) {
    $product = new ProductController();

    $product->find($id);
});

// CARTS

Route::get('/api/carts', function () {
    $carts = new CartController();

    $carts->index();
});

Route::get('/api/carts/{id}', function ($id) {
    $cart = new CartController();

    $cart->find($id);
});

Route::post('/api/carts/', function () {
    $cart = new CartController();
    $cart->create();
});

// SELLER

Route::get('/api/seller/{$id}/products', function ($id) {
    $seller = new SellerController();
    $seller->getAllProducts($id);
});

Route::post('/api/seller/{id}/products', function ($id) {
    $seller = new SellerController();
    $seller->createProduct($id);
});
