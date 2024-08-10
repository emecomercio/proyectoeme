<?php
require_once CONTROLLERS . "UserController.php";
/*
DECLARAR RUTAS GET
*/

// Ruta GET con llamada a controlador
Route::get('/dashboard', function () {
    UserController::getUsers();
});

/*
DECLARAR RUTAS POST
*/


Route::post('/login', function () {
    UserController::login();
});




// HAY QUE ELIMINAR ESTE ARCHIVO