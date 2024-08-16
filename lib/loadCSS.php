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
