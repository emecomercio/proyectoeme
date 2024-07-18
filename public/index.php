<?php
require_once "../config.php";
require_once ROOT . "/routes/web.php";
function space()
{
    echo "<br><br>";
}
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

echo Route::dispatch($uri, $method);
