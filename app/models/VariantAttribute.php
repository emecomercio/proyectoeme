<?php

namespace App\Models;

/**
 * @property id $id
 * @property id $variant_id
 * @property string $name
 * @property string $value
 */

class VariantAttribute extends Model
{   
    public $id;
    public $variant_id;
    public $name;
    public $value;

/**
 * @param array $data
 */
    public  function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'variant_attributes';
    }
}
