<?php
require CONTROLLERS . "ProductController.php";

// Define una ruta GET y ejecuta una funcion (bloque de codigo) cualquiera 
Route::get('/', function () {
    $products = ProductController::getProducts();
    view("homepage", [
        "products" => $products
    ]);
});

// Define una ruta GET con parametros y ejecuta una funcion (bloque de codigo) cualquiera que puede pasarsele parametros 
Route::get('/users/{id}', function ($id) {
    return "User with id: " . $id;
});

// get type route, call ProductController


Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/cart', function () {
    return view('cart');
});
// Route::get('/forgot', function () {
//     return view('forgot');
// });
// Route::get('/reset', function () {
//     return view('reset');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
// Route::get('/profile', function () {
//     return view('profile');
// });
// Route::get('/settings', function () {
//     return view('settings');
// });
// Route::get('/tables', function () {
//     return view('tables');
// });
