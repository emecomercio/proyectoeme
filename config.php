<?php

session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        "role"  => $_ENV["APP_ENV"] == 'dev' ? 'admin' : 'guest',
    ];
}
