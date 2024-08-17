<?php
require_once CONTROLLERS . "UserController.php";

// Define una ruta POST y ejecuta una funcion (bloque de codigo) cualquiera 
Route::post('/register-user', function () {
    UserController::register();
});

Route::post('/login', function () {
    UserController::login();
});
