<?php

namespace App\Api\Controllers;

use App\Models\ProductModel;

class ProductController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }


    public function index()
    {
        $products = $this->productModel->all();

        header('Content-Type: application/json');

        echo json_encode($products);
    }

    public function find($id)
    {
        $product = $this->productModel->find($id);

        header('Content-Type: application/json');

        echo json_encode($product);
    }
}
