<?php

namespace App\Controllers;

use Lib\View;
use App\Models\CatalogModel;

class HomeController extends BaseController
{
    protected $userController;
    protected $productController;
    protected $categoryModel;

    public function __construct($role)
    {
        parent::__construct($role);
        $this->userController = new UserController($role);
        $this->productController = new ProductController($role);
        $this->categoryModel = new CatalogModel($role);
    }

    public function index()
    {
        $catalogs = $this->categoryModel->all();
        $products = $this->productController->allWithVariants();
        shuffle($products);
        $home = new View("home", getUserRole());
        $home->data = [
            "title" => "Home Page | EME Comercio",
            "products" => $products,
            "catalogs" => $catalogs
        ];
        $home->styles = [
            "pages/homepage"
        ];
        $home->scripts = [
            [
                "type" => "module",
                "src" => "/js/pages/homepage.js"
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
                "pages/dashboard"
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
        $view = new View("static/terms-and-conditions", "alter/$this->role");
        $view->data = [
            'title' => 'Términos y Condiciones'
        ];
        $view->styles = [
            'pages/terms-and-conditions'
        ];
        $view->render();
    }
}
