<?php

use Lib\Route;
use App\Models\User;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Models\Product;

Route::get('/', function () {
    $homeController = new HomeController();
    return $homeController->index();
});


Route::get('/terms-and-conditions', function () {
    $homeController = new HomeController();
    return $homeController->termsAndConditions();
});

// Products
Route::get('/product-page/{id}/{variantNumber}', function ($id, $variantNumber) {
    $productController = new ProductController();
    $productController->index($id,  $variantNumber);
});

Route::get('/category/{$id}',  function ($id) {
    $categoryController = new CategoryController();
    return $categoryController->index($id);
});

// Shared / Users

Route::get('/cart',  function () {
    $userController = new UserController();
    return $userController->cart();
});

Route::get('/register/{role}',   function ($role) {
    $userController = new UserController();
    return $userController->showRegisterForm($role);
});

Route::get('/login',   function () {
    $userController = new UserController();
    return $userController->showLoginForm();
});
