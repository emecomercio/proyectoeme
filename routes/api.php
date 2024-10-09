<?php

use App\Api\Controllers\UserController;
use Lib\Route;

Route::post('/api/users', function () {
    $userController = new UserController();
    $userController->register();
});

Route::post('/api/login',  function () {
    $userController = new UserController();
    $userController->login();
});

Route::get('/api/logout', function () {
    $userController = new UserController();
    $userController->logout();
});
