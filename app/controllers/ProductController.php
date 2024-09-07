<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Lib\View;

class ProductController extends BaseController
{
    protected $role;
    protected $productModel;

    public function __construct($role)
    {
        $this->productModel = new ProductModel($role);
    }

    public function all()
    {
        $products = $this->productModel->all();
        return $products;
    }

    public function index($id)
    {
        $product = $this->productModel->find($id);
        $view = new View('products/show');
        $view->data = [
            "title" => $product['name'],
            "product" => $product
        ];
        $view->styles = [
            "pages/product-page"
        ];
        $view->scripts = [
            [
                "type" => "module",
                "src" => "/js/main.js"
            ],
            [
                "type" => "module",
                "src" => "/js/pages/product_page.js"
            ]
        ];

        return $view->render();
    }
}
