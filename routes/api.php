<?php

use Lib\Route;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\ProductController;


Route::get('/pruebita', function () {
    $roles = json_decode($_ENV['DB_USERS'], true);
    var_dump($roles['admin']);
});

// AUTH

Route::post('/api/login', function () {
    $role = getUserRole();
    $auth = new AuthController($role);
    $auth->login();
});

Route::post('/api/register', function () {
    $role = getUserRole();
    $authController = new AuthController($role);
    $authController->create();
});

// USERS

Route::get('/api/users', function () {
    // Instancia del controlador
    $role = getUserRole();
    $users = new UserController($role);
    // Llama al método 'index' en el controlador
    $users->index();
});

Route::get('/api/users/{id}', function ($id) {
    $role = getUserRole();
    $user = new UserController($role);
    $user->find($id);
});


// PRODUCTS

Route::get('/api/products', function () {
    $role = getUserRole();
    $products = new ProductController($role);

    $products->index();
});

Route::get('/api/products/{id}', function ($id) {
    $role = getUserRole();
    $product = new ProductController($role);

    $product->find($id);
});

// CARTS

Route::get('/api/carts', function () {
    $carts = new CartController();

    $carts->index();
});

Route::get('/api/cart/{id}', function ($id) {
    $cart = new CartController();

    $cart->find($id);
});
