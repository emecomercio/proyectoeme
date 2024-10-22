<?php

require_once __DIR__ . "/../vendor/autoload.php";  // Cargar el autoload
require_once  __DIR__ . "/../config.php";  // Cargar la configuración
require_once __DIR__ . "/../lib/functions.php";
require_once __DIR__ . "/../routes/web.php";

use Lib\Route;

// Tomamos la URI (ej /settings)
$uri = $_SERVER['REQUEST_URI'];
// Tomamos el metodo HTTP (ej: GET)
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
