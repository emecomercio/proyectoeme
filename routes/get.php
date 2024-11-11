<?php

use Lib\Route;
use App\Models\User;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Models\Product;
use Lib\Middleware;

Route::get('/', [HomeController::class, 'index']);

Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions']);

// Products
Route::get('/product-page/{id}/{variantNumber}', [ProductController::class, 'index']);

Route::get('/category/{$id}',  function ($id) {
    $categoryController = new CategoryController();
    return $categoryController->index($id);
}); //cambiar parametro

Route::get('/search', [ProductController::class, 'search']);



// Shared / Users

Route::get('/cart',  [UserController::class, 'cart'], [Middleware::checkRole('buyer')]);


Route::get('/register/{role}',   function ($role) {
    $userController = new UserController();
    return $userController->showRegisterForm($role);
});

Route::get('/register',   function () {
    redirect("/register/buyer");
});

Route::get('/login',   function () {
    $userController = new UserController();
    return $userController->showLoginForm();
});


// SELLER

Route::get('/dashboard', [UserController::class, 'dashboard']);
