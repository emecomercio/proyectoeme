<?php

namespace App\Models;

class CategoryKeyword extends Model
{
    protected $table = 'category_keywords';
    public $id;
    public $category_id;
    public $keyword;

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
