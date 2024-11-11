<?php

namespace App\Models;

class CartLine extends  Model
{
    protected $table = 'cart_lines';
    public int $id;
    public int $cart_id;
    public int $variant_id;
    public float $quantity;
    public float $price;

    public function getCart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function  getVariant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
