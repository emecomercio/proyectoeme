<?php

namespace App\Models;

class Cart extends  Model
{
    protected $table = 'carts';
    public $id;
    public $user_id;
    public $total_price;
    public $status;
    public $lines = [];

    public function getLines()
    {
        return $this->hasMany(CartLine::class, 'cart_id');
    }

    public function getBuyer()
    {
        $seller = new Buyer();
        return $seller->find($this->user_id);
    }

    public function setLine($data)
    {
        $line = new CartLine();
        $line->cart_id =  $this->id;
        $line->product_id = $data['variant_id'];
        $line->quantity = $data['quantity'];
        $line->price = $data['price'];
        $this->lines[] = $line;
    }
}
