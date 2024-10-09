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
    protected $table = 'product_variants';
    public $id;
    public $product_id;
    public $discount_id;
    public $stock;
    public $current_price;
    public $last_price;
    public $attributes = [];
    public $images = [];

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getDiscount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
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
