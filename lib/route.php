<?php
function route($route)
{
    header("Location: $route");
    exit;
}
