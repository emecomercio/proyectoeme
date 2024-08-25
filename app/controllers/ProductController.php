<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Controllers\ImageController;

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
        $product['images'] = ImageController::getImagesByProduct($id);
        $product['image_500x500'] = ImageController::getImageBySize($product['id'], 500, 500);
        return $product;
    }

    public static function getProductsForHomepage()
    {
        $productModel = new ProductModel();
        $products = $productModel->all();

        foreach ($products as &$product) {
            $product['images'] = ImageController::getImagesByProduct($product['id']);
            $product['image_500x500'] = ImageController::getImageBySize($product['id'], 500, 500);
        }

        return $products;
    }
}
