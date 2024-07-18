<?php
/*
DECLARAR RUTAS GET
*/

// Ruta GET con llamada a controlador
Route::get('/dashboard', function () {
    UserController::hello();
});

/*
DECLARAR RUTAS POST
*/


Route::post('/login', function () {
    UserController::login();
});
