<?php
/* Punto de entrada */

use Lib\Route;

session_start(); // Iniciar una sesion

require_once __DIR__ . "/../vendor/autoload.php";  // Cargar el autoload
require_once __DIR__ . "/../lib/functions.php";
require_once __DIR__ . "/../routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

// Tomamos la URI (ej proyecto.com/settings)
$uri = $_SERVER['REQUEST_URI'];
// Tomamos el metodo HTTP (ej: GET)
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
