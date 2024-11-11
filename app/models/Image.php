<?php

namespace App\Models;

class Image extends Model
{
    protected string $table = 'images';
    public int|null $id;
    public int $variant_id;
    public string $src;
    public string $alt = "Product image";

    public function getProduct()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }

    public function store() {}
}
