<?php

use Lib\Route;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\ProductController;


// USERS

Route::get('/api/users', function () {
    // Instancia del controlador
    $users = new UserController();

    // Llama al método 'index' en el controlador
    $users->index();
});

Route::get('/api/user/{id}', function ($id) {
    $user = new UserController();

    $user->find($id);
});

// PRODUCTS

Route::get('/api/products', function () {
    $products = new ProductController();

    $products->index();
});

Route::get('/api/product/{id}', function ($id) {
    $product = new ProductController();

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
