<?php

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
    $filepath = $_ENV['ROOT'] . "/views/" . $render . ".php";
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        $error = "Se intentó cargar el componente '$render' pero no se encontró el archivo";
        echo "<span style='  color: #d8000c; background-color: #ffd2d2; padding: 3px; border: 1px solid #d8000c; border-radius: 5px; font-weight: bold; font-size: 0.8em; display: inline-block; max-width: 500px;'>$error</span>";
    }
}

function getUserRole()
{
    return getUser('role') ?? ($_ENV['DB_ENV'] == 'prod' ? 'guest' : 'admin');
}

function getUser($key = '')
{
    if (!isset($_SESSION['user'])) {
        return null;
    }

    $user = json_decode($_SESSION['user']);
    return !empty($key) ? ($user->$key ?? null) : $user;
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
