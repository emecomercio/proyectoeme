<?php

namespace App\Controllers;

class BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = getUserRole();
    }

    protected function render($view, $data = [])
    {
        extract($data);
        $filepath = $_ENV['ROOT'] . "/views/" . $view . ".php";
        if (file_exists($filepath)) {
            include $filepath;
        } else {
            $error = "Se intentó cargar el componente '$view' pero no se encontró el archivo";
            echo "<span class='error-msg'>$error</span>";
        }
    }
}
