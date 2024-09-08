<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use Lib\View;

class ProductController extends BaseController
{
    protected $role;
    protected $productModel;
    protected $catalogModel;

    public function __construct($role)
    {
        $this->role = $role;
        $this->productModel = new ProductModel($role);
        $this->catalogModel = new CartModel($role);
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

    public function getByCatalog($id)
    {
        $products = $this->productModel->getByCatalog($id);
        return $products;
    }

    public function showCatalog($id)
    {
        $products = $this->getByCatalog($id);
        $view = new View('catalogs/show', $this->role);
        $view->data = [
            "title" => "Catalog | EME Comercio",
            "products" => $products
        ];
        $view->styles = [
            "pages/catalog"
        ];
        $view->render();
    }
}
