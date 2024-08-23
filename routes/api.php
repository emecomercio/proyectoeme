<?php

use Lib\Route;
use App\Api\Controllers\UserController;


Route::get('/users', function () {
    return UserController::index();
});
