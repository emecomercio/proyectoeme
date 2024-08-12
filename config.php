<?php
define('ROOT', "/laragon/www/proyectoeme");
define('APP', ROOT . "/app/");
define('VIEWS', APP . "views/");
define('MODELS', APP . "models/");
define('CONTROLLERS', APP . "controllers/");
define('LIB', ROOT . "/lib/");
// define('IMAGES', "img/");

$env = [
    "DB_NAME" => "tienda",
    "DB_HOST" => "localhost",
    "DB_USER" => "root",
    "DB_PASSWORD" => "root"
];
// Se accede a ellas asi: $env["CONSTANTE"]