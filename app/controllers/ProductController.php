<?php
require_once MODELS . "ProductModel.php";
class ProductController
{
    static public function getProducts()
    {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        return $products;
    }
}
