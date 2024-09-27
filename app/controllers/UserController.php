<?php

namespace App\Controllers;

use App\Models\CatalogModel;
use App\Models\UserModel;
use Lib\View;

class UserController extends BaseController
{       
    protected $catalogModel;
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->catalogModel = new CatalogModel();

    }

    public function showLogin($msg = '')
    {
        $_SESSION['msg']['login'] = $msg;
        redirect('/login');
    }

    public function cart()
    {

        $view = function ($role) {
            $cart = new View("$role/cart", $role);
            $cart->data = [
                "title" => "Carrito | EME Comercio",

            ];
            $cart->styles = [
                "pages/cart"
            ];
            $cart->scripts = [
                [
                    "type" => "",
                    "src" => "/js/components/cart_products.js",
                    "defer" => true

                ]
            ];
            $cart->render();
        };
        $this->role != 'admin' || $this->role != 'seller'
            ? $view($this->role)
            : redirect('/');
    }

    public function settings()
    {
        $show = function ($view) {
            $settings = new View($view, $this->role);
            $settings->data = [
                "title" => "Settings | EME Comercio"
            ];
            $settings->styles = [
                "pages/settings"
            ];
            $settings->render();
        };
        $this->role != 'guest'
            ? $show($this->role  . "/settings")
            : $this->showLogin('Necesitas iniciar sesión primero');
    }

    public function dashboard()
    {
        $show = function ($view) {
            $catalogs = $this->catalogModel->all();
            $dashboard = new View($view, $this->role);
            $dashboard->data = [
                "title" => "Dashboard | EME Comercio",
                "user" => $this->userModel->find($_SESSION['user']['id']),
                "catalogs" => $catalogs
            ];
            $dashboard->styles = [
                "pages/dashboard",
                "pages/home-entrepise"
            ];
            $dashboard->render();
        };
        $this->role != 'seller'
            ? redirect('/')
            : $show($this->role  . "/dashboard");
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        $this->showLogin('Sesión cerrada con éxito');
    }
}
