<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController
{
    public static function all()
    {
        $productModel = new ProductModel();
        $products = $productModel->all();
        return $products;
    }
    public static function find($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        return $product;
    }

    public static function getProductsForHomepage()
    {
        $productModel = new ProductModel();
        $products = $productModel->all();

        return $products;
    }
}
