<?php

namespace App\Models;

/**
 * 
 * @property int $id
 * @property strint $name
 * @property int $discount_id
 * @property array $keywords
 */
class Category extends Model
{
    protected $table = 'categories';
    public $id;
    public $discount_id;
    public $name;
    public $keywords = [];

    public function getProducts()
    {
        return $this->hasMany(Product::class,  'category_id');
    }

    public function getKeywords($toString = false)
    {
        if ($toString) {
            $keywordModel = new CategoryKeyword();
            $keywords = $keywordModel->select('keyword')->where('category_id', "=", $this->id)->get(false);

            $keywordString = '';
            foreach ($keywords as $index => $keyword) {
                $keywordString .= ($index > 0 ? ' ' : '') . $keyword['keyword'];
            }
            return $keywordString;
        }

        return $this->hasMany(CategoryKeyword::class, 'category_id');
    }
}
