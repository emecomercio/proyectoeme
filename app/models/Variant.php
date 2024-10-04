<?php

namespace App\Models;

/**
 * @property int $id
 * @property int $product_id
 * @property int $discount_id
 * @property int $stock
 * @property int $current_price
 * @property int $latest_price
 * @property VariantAttribute[] $attributes
 * @property Image[] $images
 */

class Variant extends Model
{
    public $id;
    public $product_id;
    public $discount_id;
    public $stock;
    public $current_price;
    public $last_price;
    public $attributes = [];
    public $images = [];

/**
 * @param array $data
 */
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
