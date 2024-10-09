<?php

namespace App\Models;

class Image extends Model
{
    protected $table = 'images';
    public $id;
    public $variant_id;
    public $src;
    public $alt;


    public function getProduct()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
