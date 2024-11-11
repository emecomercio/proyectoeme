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
    public bool $active = 1;
    public bool $type = 0;
    public int $value;
    public int|null $max;

    public function getSeller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
