<?php
require_once CONTROLLERS . "UserController.php";

// Define una ruta POST y ejecuta una funcion (bloque de codigo) cualquiera 
Route::post('/enviar', function () {
    return "hola" . $_POST['name'] . " desde post";
});

Route::post('/login', function () {
    UserController::login();
});
