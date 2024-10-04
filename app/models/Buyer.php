<?php

namespace App\Models;

class Buyer  extends User
{
    public $birthdate;


    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'buyers';
    }
}
