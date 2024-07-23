<?php
require_once ROOT . "/lib/Route.php";


foreach (glob(ROOT . "/routes/*.php") as $file) {
    require_once $file;
}
