<?php

namespace App\Models;

class Phone extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'phones';
    }
}
