<?php

namespace App\Models;

class Discount extends Model
{
    protected $table = 'discounts';
    public int $id;
    public int $seller_id;
    public string $name;
    public string $start_date;
    public string $end_date;
    public bool $active;
    public bool $type;
    public int $value;
    public int $max;

    public function getSeller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
