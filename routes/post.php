<?php

use Lib\Route;
use App\Controllers\UserController;


// Define una ruta POST y ejecuta una funcion (bloque de codigo) cualquiera 
Route::post('/register-user', function () {
    UserController::register();
});

Route::post('/login', function () {
    UserController::login();
});
