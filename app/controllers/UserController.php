<?php

namespace App\Controllers;

use Lib\View;
use App\Models\User;
use App\Models\Phone;

class UserController extends Controller
{
    protected  $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index() {}

    public function showRegisterForm($role)
    {
        $register = new View("auth/$role/register");
        $register->data = [
            'title' => 'Registro de ' . ($role == 'buyer' ? 'comprador' : 'vendedor')
        ];
        $register->styles = [
            '/css/pages/register-login.css'
        ];
        $register->scripts = [
            [
                'src' => '/js/pages/register.js',
                'defer' => true
            ]
        ];
        $register->render();
    }

    public function showLoginForm()
    {
        $msg = $_SESSION['msg']['login'] ?? '';
        unset($_SESSION['msg']['login']);
        $login = new View('auth/login', 'alter');
        $login->data = [
            'title' => 'Login ',
            'msg' => $msg
        ];
        $login->styles = [
            '/css/pages/register-login.css'
        ];
        $login->scripts = [
            [
                'src' => '/js/pages/login.js',
                'defer' => true
            ]
        ];
        $login->render();
    }

    public function cart()
    {

        $view = function ($role) {
            $cart = new View("$role/cart");
            $cart->data = [
                "title" => "Carrito",

            ];
            $cart->styles = [
                "/css/pages/cart.css"
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
        getUserRole() != 'admin' || getUserRole() != 'seller'
            ? $view(getUserRole())
            : redirect('/');
    }

    public function dashboard()
    {
        $show = function ($view) {
            $dashboard = new View($view);
            $dashboard->data = [
                "title" => "Dashboard",
            ];
            $dashboard->styles = [
                "/css/pages/dashboard.css",
                "/css/pages/home-entrepise.css"
            ];
            $dashboard->scripts = [
                [
                    "src" => "/js/pages/seller_dashboard.js",
                    "defer" => true
                ],
            ];
            $dashboard->render();
        };
        getUserRole() == 'guest'
            ? redirect('/')
            : $show(getUserRole()  . "/dashboard");
    }
}
