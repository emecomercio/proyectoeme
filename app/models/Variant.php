<?php

namespace App\Models;

class Variant extends Model
{
    public $id;
    public $product_id;
    public $discount_id;
    public $stock;
    public $current_price;
    public $last_price;
    public $attributes = [];
    /**
     * 
     *
     * @var Image[]
     */
    public $images = [];


    public  function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'product_variants';
    }

    public function getAttributes()
    {
        return $this->hasMany(VariantAttribute::class,  'variant_id');
    }

    public function  getImages()
    {
        return $this->hasMany(Image::class,  'variant_id');
    }
}
