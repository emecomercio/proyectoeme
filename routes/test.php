<?php

use App\Controllers\UserController;
use Lib\Route;

Route::get("/", function () {
    $userController = new UserController();
    return $userController->phones();
});
