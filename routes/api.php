<?php

use Lib\Route;
use Lib\Middleware;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\ImageController;
use App\Api\Controllers\SearchController;
use App\Api\Controllers\SellerController;
use App\Api\Controllers\ProductController;
use App\Api\Controllers\VariantController;

Route::post('/api/users', function () {
    $userController = new UserController();
    $userController->register();
});

Route::get('/api/sellers/{id}', [SellerController::class, 'find']);

Route::post('/api/login', [AuthController::class, 'login']);
Route::get('/api/logout', [AuthController::class, 'logout']);

// Cart
Route::post('/api/carts/current/lines', [CartController::class, 'addLine']);
Route::delete('/api/carts/current/lines/{id}', [CartController::class, 'deleteLine']);

Route::put('/api/carts', [CartController::class, 'closeCart']);


// Hay que cambiar los middleware para las API
Route::get('/api/carts/current', [CartController::class, 'getCurrentCart']);

Route::post('/api/images', [ImageController::class, 'create']);

// Products
Route::post('/api/products', [ProductController::class, 'create']);

Route::get('/api/variants/{id}', [VariantController::class, 'find']);

Route::get('/api/search', [SearchController::class, 'index']);
