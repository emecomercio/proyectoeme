<?php

namespace App\Api\Controllers;

use Exception;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct($role)
    {
        $this->productModel = new ProductModel($role);
    }

    public function index()
    {
        try {
            $products = $this->productModel->all();
            $this->respondWithSuccess($products);
        } catch (Exception $e) {
            // Usa el método de la clase base para manejar la excepción
            $this->handleException($e, "Error retrieving products");
        }
    }

    public function find($id)
    {
        try {
            $product = $this->productModel->find($id);

            if (!$product) {
                $this->respondWithError("Product not found", 404);
            } else {
                $this->respondWithSuccess($product);
            }
        } catch (Exception $e) {
            $this->handleException($e, "Error retrieving product");
        }
    }
}
