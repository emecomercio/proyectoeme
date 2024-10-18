<?php

namespace App\Models;

/**
 * Undocumented class
 * 
 * @property array<CartLine> $lines
 */
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


    public function fillLines()
    {
        $lines = $this->getLines();

        foreach ($lines as $line) {
            $this->setLine($line);
        }
    }

    public function setLine(array|CartLine $data)
    {

        if (is_array($data)) {
            $line = new CartLine();
            $line->cart_id =  $this->id;
            $line->product_id = $data['variant_id'];
            $line->quantity = $data['quantity'];
            $line->price = $data['price'];
            $this->lines[] = $line;
        } else {
            $line = $data;
            $this->lines[] = $line;
        }
    }

    public function save()
    {
        if (!empty($this->lines)) {
            $this->total_price = 0;
            foreach ($this->lines as &$line) {
                $this->total_price += $line->price;
                $line = $line->save();
            }
        }
        return parent::save();
    }
}
