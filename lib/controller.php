<?php
//function that calls a controller and renders a view

function controller($controller, $action)
{
    require_once(CONTROLLERS . $controller . '.php');

    $controller::$action();
}
