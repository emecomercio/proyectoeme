<?php

namespace App\Controllers;

use Lib\View;
use App\Models\CatalogModel;

class HomeController extends BaseController
{
    protected $userController;
    protected $productController;
    protected $catalogModel;

    public function __construct()
    {
        parent::__construct();
        $this->userController = new UserController();
        $this->productController = new ProductController();
        $this->catalogModel = new CatalogModel();
    }

    public function index()
    {
        $products = $this->productController->allWithVariants();
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
    public function dashboard()
    {
        $show = function ($view) {
            $dashboard = new View($view);
            $dashboard->data = [
                "title" => "Dashboard | EME Comercio"
            ];
            $dashboard->styles = [
                "/css/pages/dashboard.css"
            ];
            $dashboard->scripts = [
                [
                    "type" => "module",
                    "src" => "js/main.js"
                ],
                [
                    "type" => "module",
                    "src" => "js/pages/dashboard.js"
                ]
            ];
            $dashboard->render();
        };
        $this->role != 'guest'
            ? $show($this->role  . "/dashboard")
            : $this->userController->showLogin('Necesitas iniciar sesión primero');
    }



    public function termsAndConditions()
    {
        $view = new View("static/terms-and-conditions");
        $view->data = [
            'title' => 'Términos y Condiciones'
        ];
        $view->styles = [
            '/css/pages/terms-and-conditions.css'
        ];
        $view->render();
    }
}
