<?php

namespace App\Models;

class Image extends Model
{
    protected $table = 'images';
    public int $id;
    public int $variant_id;
    public string $src;
    public string $alt;

    public function getProduct()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }

    public function store() {}
}
