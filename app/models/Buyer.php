<?php

namespace App\Models;

class Buyer extends User
{
    protected $table = "buyers";
    public $birthdate;
}
