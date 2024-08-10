<?php
function view($view, $data = [])
{
    extract($data);
    require VIEWS . $view . ".php";
}
