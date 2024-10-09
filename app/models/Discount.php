<?php

namespace App\Models;

class Discount extends Model
{
    protected $table = 'discounts';
    public $id;
    public $seller_id;
    public $name;
    public $start_date;
    public $end_date;
    public $active;
    public $type;
    public $value;
    public $max;

    public function getSeller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
