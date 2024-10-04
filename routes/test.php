<?php

use App\Controllers\UserController;
use App\Models\Image;
use App\Models\Seller;
use App\Models\User;
use Lib\Route;

Route::get("/test", function () {
    $user = new Seller();
    return dd($user->find(66));



    $image = new Image(['id' => 1, 'variant_id' => 34]);
    return dd($image->getProduct());
});
