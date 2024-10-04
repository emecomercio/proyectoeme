<?php

namespace App\Models;

class Image extends Model
{
    public $id;
    public $variant_id;
    public $src;
    public $alt;

    public  function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'images';
    }

    public function getProduct()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
