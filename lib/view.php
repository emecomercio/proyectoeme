<?php
function view($view, $data = [])
{
    extract($data);
    require_once VIEWS . $view . ".php";
}
