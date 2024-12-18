<?php

use App\Api\Controllers\AuthController;
use App\Models\Category;

function asset($path = "")
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
        return htmlspecialchars($path);
    } else {
        return '<!-- Archivo no encontrado: ' . $path . ' -->';
    }
}

function redirect($route)
{
    header("Location: $route");
    exit();
}

function render($render, $data = [])
{
    extract($data);
    $filepath = $_ENV['APP_ROOT'] . "/views/" . $render . ".php";
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        $error = "Se intentó cargar el componente '$render' pero no se encontró el archivo";
        echo "<span style='  color: #d8000c; background-color: #ffd2d2; padding: 3px; border: 1px solid #d8000c; border-radius: 5px; font-weight: bold; font-size: 0.8em; display: inline-block; max-width: 500px;'>$error</span>";
    }
}

function getUser($key = '')
{
    try {
        $user = AuthController::getToken();

        if (!empty($key)) {
            return property_exists($user, $key) ? $user->$key : null;
        }

        return $user;
    } catch (\Exception $e) {
        $defaultUser = $_ENV["APP_ENV"] != "dev" ? (object) [
            'id' => null,
            'role' => 'guest',
            'name' => 'Usuario',
            'email' => null,
            'username' => 'Usuario'
        ] :
            (object) [
                'id' => null,
                'role' => 'admin',
                'name' => 'Administrador',
                'email' => null,
                'username' => 'Administrador'
            ];

        return !empty($key) ? ($defaultUser->$key ?? null) : $defaultUser;
    }
}




function dd($arg, $debug = false)
{
    if ($debug) {
        echo "<pre>";
        print_r($arg);
        echo "</pre>";
    } else {
        echo '<pre>';
        print_r($arg);
        echo '</pre>';
        exit;
    }
}

function getCategories()
{
    $categoryModel = new Category();
    return $categoryModel->all();
}

function bcrypt($password)
{
    $hash =  password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}


function getLogoHref()
{
    if (getUser('role') == 'seller') {
        echo '/dashboard';
    } else if (getUser('role') === 'buyer' ||  getUser('role') === 'guest') {

        echo '/';
    }
}
function getCarouselHref()
{
    if (getUser('role') == 'guest') {
        return "/img/Carrousel/Unete_ahora.png";
    } else if (getUser('role') === 'buyer') {
        return "/img/Carrousel/nuevas_modas.webp";
    }
}
