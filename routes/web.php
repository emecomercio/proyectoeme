<?php
require_once ROOT . "/lib/Route.php";
require_once CONTROLLERS . "UserController.php";

foreach (glob(ROOT . "/routes/*.php") as $file) {
    require_once $file;
}
