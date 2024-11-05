<?php

namespace App\Api\Controllers;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function create()
    {
        $product = $_POST;
        $user = $this->verifyToken();

        if (empty($product)) {
            throw new Exception('Product data is empty', 400);
        }
        if (strlen($product['description']) >= 350) {
            throw new Exception('Description is too long, max 350 characters', 400);
        }

        if (empty($product['name'])) {
            throw new Exception('Product name is empty', 400);
        }

        $categoryId = $product['categoryId'];
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        if (!$category) {
            throw new Exception('Category not found', 404);
        }

        $sellerModel = new Seller();
        $seller = $sellerModel->find($user->user_id);
        if (!$seller) {
            throw new Exception('Seller not found', 404);
        }

        if (empty($product['variants']) || count($product['variants']) < 1) {
            throw new Exception('At least one variant is required');
        }

        $productModel = new Product();
        $productModel->beginTransaction();


        try {
            $createdProduct = $productModel->create([
                'name' => $product['name'],
                'description' => $product['description'],
                'category_id' =>  $categoryId,
                'seller_id' => $user->user_id,
            ]);
            $variantController = new VariantController();
            foreach ($product['variants'] as $variantIndex => $variant) {
                $createdProduct->variants[] = $variantController->create($variant, $variantIndex, $createdProduct->id);
            }

            $productModel->commit();
            $this->respondWithSuccess($createdProduct);
        } catch (\Exception $e) {
            $productModel->rollBack();
            throw $e;
        }
    }
}
