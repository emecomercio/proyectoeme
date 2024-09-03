<?php

use Lib\Route;

session_start();
require_once "../vendor/autoload.php";
require_once "../lib/functions.php";
require_once "../routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
