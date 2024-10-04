<?php

namespace App\Models;

class Category extends Model
{
    public $id;
    public $name;


    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'categories';
    }
}
