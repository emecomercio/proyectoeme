<?php

use App\Models\Model;

session_start(); // Iniciar una sesion
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        "role"  => $_ENV["DB_ENV"] == 'dev' ? 'admin' : 'guest',
    ];
}

if (!file_exists($_ENV["UPLOADS"])) {
    mkdir($_ENV["UPLOADS"], 0777, true);
}
if (!file_exists($_ENV["UPLOADS"] . '/products')) {
    mkdir(($_ENV["UPLOADS"] . "/products"), 0777, true);
}

$generate = false;

if ($generate) {

    $model = new Model();
    $model->realProduct();
}
