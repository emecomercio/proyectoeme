<?php
function loadCSS($filename = "global")
{
    $base_path = "/css/";
    $full_path = $base_path . $filename . ".css";
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $full_path)) {
        echo "<link rel='stylesheet' type='text/css' href='{$full_path}'>";
    } else {
        echo '<!-- Archivo CSS no encontrado: ' . $full_path . ' -->';
    }
}


function loadIMG($filename)
{
    $base_path = "/img/";
    $type = isset($path_info['extension']) ? $path_info['extension'] : '';
    $full_path = $base_path . $filename . $type;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $full_path)) {
        echo $full_path;
    } else {
        echo '<!-- Archivo CSS no encontrado: ' . $full_path . ' -->';
    }
}

function asset($path = "")
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
        echo htmlspecialchars($path);
    } else {
        echo '<!-- Archivo CSS no encontrado: ' . $path . ' -->';
    }
}

function redirect($route)
{
    header("Location: $route");
    exit();
}

function view($view, $data = [])
{
    extract($data);
    $filepath =  $_ENV['ROOT'] . "/app/views/" . $view . ".php";
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        $error = "Se intentó cargar la vista '$view' pero no se encontro el archivo";
        echo "<span class='error-msg'>$error</span>";
    }
}
function renderComponent($view, $data = [])
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
