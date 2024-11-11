<?php

namespace App\Models;

/**
 * @property id $id
 * @property id $variant_id
 * @property string $name
 * @property mixed $value
 */

class VariantAttribute extends Model
{
    protected $table = 'variant_attributes';
    public int $id;
    public int $variant_id;
    public string $name;
    public string $value;

    public function getVariant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
