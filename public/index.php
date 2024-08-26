<?php

use Lib\Route;

session_start();
require_once "../vendor/autoload.php";
require_once "../lib/functions.php";
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

require_once "../routes/web.php";
require_once "../lib/functions.php";
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
