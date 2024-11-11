<?php

namespace App\Models;

class CategoryKeyword extends Model
{
    protected $table = 'category_keywords';
    public int $id;
    public int $category_id;
    public string $keyword;

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
