<?php

namespace App\Controllers;

use App\Models\Product;
use Lib\View;

class HomeController extends Controller
{
    public $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new Product();
    }

    public function getProductsForIndex()
    {
        $products = $this->productModel->select('id', 'name')->limit(50)->get();
        foreach ($products as &$product) {
            $variants = $product->getVariants();
            foreach ($variants as &$variant) {
                $attributes = $variant->getAttributes();
                $variant->attributes = $attributes;
                $images = $variant->getImages();
                $variant->images = $images;
            }
            $product->variants = $variants;
        }
        return $products;
    }


    public function index()
    {
        $products = $this->getProductsForIndex();
        shuffle($products);
        $home = new View("home");
        $home->data = [
            "title" => "Home Page | EME Comercio",
            "products" => $products
        ];
        $home->styles = [
            "/css/pages/homepage.css"
        ];
        $home->scripts = [
            [
                "type" => "module",
                "src" => "/js/pages/homepage.js"
            ],
            [
                "src" => "/js/components/carrousel_products.js",
                "defer" => true
            ]
        ];
        $home->render();
    }

    public static function termsAndConditions()
    {
        $view = new View("static/terms-and-conditions", 'alter');
        $view->data = [
            'title' => 'Términos y Condiciones'
        ];
        $view->styles = [
            '/css/pages/terms-and-conditions.css'
        ];
        $view->render();
    }
}
