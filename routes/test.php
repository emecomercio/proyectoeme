<?php

use Lib\Route;

class Test
{
    public $att;
    public function test($t = '')
    {
        return ('test' . $t);
    }
}

Route::get("/test/{id}", [Test::class,  'test']);
