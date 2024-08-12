<?php
require_once MODELS . "ProductModel.php";
require_once CONTROLLERS . "ImageController.php";
class ProductController
{
    public static function getAllProducts()
    {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        return $products;
    }
    public static function getProductById($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        $product['images'] = ImageController::getImagesByProduct($id);
        $product['image_500x500'] = ImageController::getImageBySize($product['id'], 500, 500);
        return $product;
    }

    public static function getProductsForHomepage()
    {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();

        foreach ($products as &$product) {
            $product['images'] = ImageController::getImagesByProduct($product['id']);
            $product['image_500x500'] = ImageController::getImageBySize($product['id'], 500, 500);
        }

        return $products;
    }
}
