<?php

namespace App\Api\Controllers;

use App\Models\ProductModel;
use App\Models\SellerModel;

class SellerController extends  BaseController
{
    protected  $sellerModel;
    protected  $productModel;
    protected $productController;

    public function __construct()
    {
        $this->sellerModel = new SellerModel();
        $this->productModel = new ProductModel();
        $this->productController = new ProductController();
    }
    public function index()
    {
        $this->handle(function () {
            $data = $this->sellerModel->all();
            $this->respondWithSuccess($data);
        });
    }
    public function getAllProducts($id)
    {
        $this->handle(function () use ($id) {
            $products = $this->productController->getProductsBySeller($id);
            if ($products) {
                $this->respondWithSuccess($products);
            } else {
                $this->respondWithError('No products found');
            }
        });
    }

    public function createProduct()
    {
        $this->handle(function () {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->productModel->create($data);
            $this->respondWithSuccess('Product created successfully');
        });
    }
}
