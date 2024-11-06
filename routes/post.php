<?php

use Lib\Route;
use App\Controllers\UserController;


// Define una ruta POST y ejecuta una funcion (bloque de codigo) cualquiera 

Route::post('/logout', function () {
    $auth = new UserController();
    $auth->logout();
});
