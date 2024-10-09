<?php

namespace App\Models;

/**
 * @property id $id
 * @property id $variant_id
 * @property string $name
 * @property string $value
 */

class VariantAttribute extends Model
{
    protected $table = 'variant_attributes';
    public $id;
    public $variant_id;
    public $name;
    public $value;

    public function getVariant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
