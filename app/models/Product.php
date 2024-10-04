<?php

namespace App\Models;
/**
 * @property int $id
 * @property int $category_id
 * @property int $seller_id
 * @property string $name
 * @property string $description
 * @property Variant[] $variants
 */
class Product extends Model
{
    public $id;
    public $category_id;
    public $seller_id;
    public $name;
    public $description;
    public $variants;
/**
 *  @param array $data
 */
    public  function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'products';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'category_id');
    }

    public function getVariants()
    {
        return $this->hasMany(Variant::class, 'product_id',  'id', 'current_price');
    }

    public function getSeller()
    {
        return $this->hasOne(User::class, 'seller_id');
    }
}
