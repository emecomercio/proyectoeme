<?php

namespace App\Models;

class Discount extends Model
{
    protected string $table = 'discounts';
    public int|null $id;
    public int|null $seller_id;
    public string $name;
    public string $start_date;
    public string $end_date;
    public bool $active = true;
    public bool $type = false;
    public int $value;
    public int|null $max;

    public function getSeller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
