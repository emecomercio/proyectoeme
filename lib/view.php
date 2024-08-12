<?php
function view($view, $data = [])
{
    extract($data);
    $filepath =  VIEWS . $view . ".php";
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        $error = "Se intentó cargar la vista '$view' pero no se encontro el archivo";
        echo "<span class='error-msg'>$error</span>";
    }
}
