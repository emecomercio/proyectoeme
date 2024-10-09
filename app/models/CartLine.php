<?php

namespace App\Models;

class CartLine extends  Model
{
    protected $table = 'cart_lines';
    public $id;
    public $cart_id;
    public $variant_id;
    public $quantity;
    public $price;

    public function getCart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function  getVariant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
