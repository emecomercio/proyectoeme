<?php

use Lib\Route;
use Lib\Middleware;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\ImageController;
use App\Api\Controllers\ProductController;

Route::post('/api/users', function () {
    $userController = new UserController();
    $userController->register();
});

Route::post('/api/login', [AuthController::class, 'login']);
Route::get('/api/logout', [AuthController::class, 'logout']);

// Cart
Route::post('/api/carts/{id}/lines', [CartController::class, 'addLine']);

// Hay que cambiar los middleware para las API
Route::get('/api/carts', [CartController::class, 'index']);

Route::post('/api/images', [ImageController::class, 'create']);

// Products
Route::post('/api/products', [ProductController::class, 'create']);
