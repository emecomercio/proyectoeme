<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categories';
    public $id;
    public $discount_id;
    public $name;

    public function getProducts()
    {
        return $this->hasMany(Product::class,  'category_id');
    }
}
