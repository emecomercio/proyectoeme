<?php

namespace App\Controllers;

use Lib\View;
use App\Models\Product;

class ProductController extends Controller
{
    protected  $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index($id, $variantNumber)
    {
        $product = $this->productModel->find($id);
        $product->loadVariants();


        $view = new View('products/show');
        $view->data = [
            "title" => $product->name ?? 'Default',
            "product" => $product,
            "variantNumber" => $variantNumber
        ];
        $view->styles = [
            "/css/pages/product-page.css"
        ];
        $view->scripts = [
            [
                "type" => "module",
                "src" => "/js/pages/product_page.js"
            ],
        ];

        return $view->render();
    }
}
