<?php
require_once "../config.php";
require_once ROOT . "/routes/web.php";
require_once LIB . "loadJS.php";
require_once LIB . "loadCSS.php";

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
