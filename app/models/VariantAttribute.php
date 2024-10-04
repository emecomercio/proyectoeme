<?php

namespace App\Models;

class VariantAttribute extends Model
{
    public $id;
    public $variant_id;
    public $name;
    public $value;


    public  function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'variant_attributes';
    }
}
