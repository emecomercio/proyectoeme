<?php
require_once MODELS . "ProductModel.php";
require_once CONTROLLERS . "ImageController.php";
class ProductController
{
    static public function getProducts()
    {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        return $products;
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
