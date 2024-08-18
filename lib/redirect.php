<?php
function redirect($route)
{
    header("Location: $route");
    exit;
}
