<?php

namespace App\Models;

class Product extends Model
{
    /**
     * @var int $id El ID del producto.
     */
    public $id;

    /**
     * @var int $category_id El ID de la categoría a la que pertenece el producto.
     */
    public $category_id;

    /**
     * @var int $seller_id El ID del vendedor que publica el producto.
     */
    public $seller_id;

    /**
     * @var string $name El nombre del producto.
     */
    public $name;

    /**
     * @var string $description La descripción del producto.
     */
    public $description;

    /**
     * @var array<Variant> $variants Una colección de variantes del producto.
     */
    public $variants;


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
