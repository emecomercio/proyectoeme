<?php

namespace App\Controllers;

use App\Models\UserModel;
use Lib\View;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct($role)
    {
        parent::__construct($role);
        $this->userModel = new UserModel($role);
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
                "title" => "Carrito | EME Comercio"
            ];
            $cart->styles = [
                "pages/cart"
            ];
            $cart->scripts = [
                [
                    "type" => "module",
                    "src" => "js/pages/cart.js"
                ]
            ];
            $cart->render();
        };
        $this->role != 'admin' && $this->role != 'seller'
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



    // static public function register()
    // {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $user_type = $_POST['user-type'] ?? '';
    //     $password_check = $_POST['password-check'];
    //     $username = $_POST['username'];

    //     if ($userModel->existsEmail($email)) {
    //         $_SESSION['error'] = $user_type == "enterprise" ? "Ya existe una empresa registrada con ese correo" : "Ya existe un usuario con ese correo";
    //         $redirection = $user_type == "enterprise" ? "/register-enterprise" : "/register-user";
    //         redirect("$redirection");
    //     }

    //     if ($userModel->existsUsername($username)) {
    //         $_SESSION['error'] = $user_type == "enterprise" ? "Ya existe una empresa registrada con ese nombre de usuario" : "Ya existe un usuario con ese nombre de usuario";
    //         $redirection = $user_type == "enterprise" ? "/register-enterprise" : "/register-user";
    //         redirect("$redirection");
    //     }

    //     if ($password == $password_check) {
    //         $userModel->register($username, $email, $password);
    //         $user = $userModel->getUserByEmail($email);
    //         $_SESSION['user_id'] = $user["id"];
    //         $_SESSION['user_name'] = $user["username"];
    //         redirect("/");
    //     } else {
    //         echo "[No deberia llegar hasta aca] las contraseñas no coinciden";
    //     }
    // }

    // static public function login()
    // {
    //     $userModel = new UserModel;
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $user_type = $_POST['user-type'] ?? '';
    //     if ($userModel->existsEmail($email) && $userModel->validatePassword($email, $password)) {
    //         $user = $userModel->getUserByEmail($email);
    //         $_SESSION['user_id'] = $user["id"];
    //         $_SESSION['user_name'] = $user["username"];
    //         redirect("/");
    //     } else {
    //         $_SESSION['error'] = "Usuario o contraseña incorrectos";
    //         $redirection = $user_type == "enterprise" ? "/login-enterprise" : "/login-user";
    //         redirect("$redirection");
    //     }
    // }

    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        $this->showLogin('Sesión cerrada con éxito');
    }
}
