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

    public function index()
    {
        $products = $this->productModel->getProductsForHome();
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
