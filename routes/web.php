<?php

foreach (glob(ROOT . "/routes/*.php") as $file) {
    require_once $file;
}
