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
    protected string $table = 'products';
    public int|null $id;
    public int $category_id = 1;
    public int $seller_id;
    public string $name;
    public string $description;
    public array $variants = [];

    public function getProductsForHome()
    {
        $products = $this->select('id', 'name')->limit(50)->get();
        foreach ($products as &$product) {
            $variants = $product->getVariants();
            foreach ($variants as &$variant) {
                $attributes = $variant->getAttributes();
                $variant->attributes = $attributes;
                $images = $variant->getImages();
                $variant->images = $images;
            }
            $product->variants = $variants;
        }
        return $products;
    }

    public function loadVariants()
    {
        $variants = $this->getVariants();
        foreach ($variants as &$variant) {
            $attributes = $variant->getAttributes(false);
            $variant->attributes = $attributes;
            $images = $variant->getImages(false);
            $variant->images = $images;
        }
        $this->variants = $variants;
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getVariants()
    {
        $vatiantModel = new Variant();
        return $vatiantModel
            ->select("*")
            ->where("product_id", "=", $this->id)
            ->orderBy("id")
            ->get();
    }

    public function getVariantsById(int $id, bool $fetchToObj = true)
    {
        $vatiantModel = new Variant();
        $variants =  $vatiantModel
            ->select("id", "current_price", "last_price")
            ->where("product_id", "=", $id)
            ->orderBy("id")
            ->get($fetchToObj);
        if ($fetchToObj) {
            return $variants; // desp agrego logica si se necesita en otro lado
        }
        $imageModel = new Image();
        foreach ($variants as $i => &$variant) {
            $images = $imageModel
                ->select("src", "alt")
                ->where("variant_id", "=", $variant['id'])
                ->limit(1)
                ->get(false);
            if (!isset($images[0])) {
                unset($variants[$i]);
                continue;
            }
            $variant['image'] = (object) [
                'src' => $images[0]['src'],
                'alt' => $images[0]['alt']
            ];
        }
        return $variants;
    }

    public function getSeller()
    {
        $seller = new Seller();
        return $seller->find($this->seller_id);
    }
}
