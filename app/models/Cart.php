<?php

namespace App\Models;

/**
 * Undocumented class
 * 
 * @property array<CartLine> $lines
 */
class Cart extends  Model
{
    protected string $table = 'carts';
    public int|null $id;
    public int $user_id;
    public float $total_price = 0;
    public bool $status = 0;
    public array $lines = [];

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
        $this->lines = $this->getLines();
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
