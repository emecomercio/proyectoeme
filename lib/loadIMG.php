<?php

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
