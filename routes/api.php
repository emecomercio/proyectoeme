<?php

use Lib\Route;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\CartController;
use App\Api\Controllers\UserController;
use Lib\Middleware;

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
