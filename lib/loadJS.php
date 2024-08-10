<?php
function loadJS($filename = "main")
{
    $base_path = "js/";
    $full_path = $base_path . $filename . ".js";
    if (file_exists($full_path)) {
        echo "<script src='{$full_path}'></script>";
    } else {
        echo '<!-- Arhivo JS no encontrado: ' . $full_path . ' -->';
    }
}
