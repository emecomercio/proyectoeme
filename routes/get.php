<?php

use App\Controllers\HomeController;
use Lib\Route;

Route::get('/', function () {
    $homeController = new HomeController();
    return $homeController->index();
});

Route::get('/terms-and-conditions', function () {
    $homeController = new HomeController();
    return $homeController->termsAndConditions();
});
