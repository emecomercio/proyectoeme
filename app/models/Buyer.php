<?php

namespace App\Models;

class Buyer extends User
{
    protected string $table = "buyers";
    public string|null $birthdate;
}
