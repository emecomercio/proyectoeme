<?php

function loadJS($filename = "global")
{
    $base_path = "/js/";
    $full_path = $base_path . $filename . ".js";
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $full_path)) {
        echo '<script src="' . $full_path . '"></script>';
    } else {
        echo '<!-- Archivo CSS no encontrado: ' . $full_path . ' -->';
    }
}
