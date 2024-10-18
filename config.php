<?php

use App\Models\Model;

session_start(); // Iniciar una sesion
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = json_encode([
        "role"  => $_ENV["DB_ENV"] == 'dev' ? 'admin' : 'guest',
    ]);
}


$generate = false;

if ($generate) {

    $model = new Model();
    $model->realProduct();
}
