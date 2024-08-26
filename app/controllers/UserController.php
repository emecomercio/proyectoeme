<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Services\UserService;


class UserController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    // Para los estaticos tengo que instanciar manualmente el UserService
    static public function usersTable()
    {
        $userService = new UserService;
        $users = $userService->all();
        view("usersTable", [
            "users" => $users,
            "title" => "Usuarios"
        ]);
    }

    static public function register()
    {
        $userModel = new UserModel;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['user-type'] ?? '';
        $password_check = $_POST['password-check'];
        $username = $_POST['username'];

        if ($userModel->existsEmail($email)) {
            $_SESSION['error'] = $user_type == "enterprise" ? "Ya existe una empresa registrada con ese correo" : "Ya existe un usuario con ese correo";
            $redirection = $user_type == "enterprise" ? "/register-enterprise" : "/register-user";
            redirect("$redirection");
        }

        if ($userModel->existsUsername($username)) {
            $_SESSION['error'] = $user_type == "enterprise" ? "Ya existe una empresa registrada con ese nombre de usuario" : "Ya existe un usuario con ese nombre de usuario";
            $redirection = $user_type == "enterprise" ? "/register-enterprise" : "/register-user";
            redirect("$redirection");
        }

        if ($password == $password_check) {
            $userModel->register($username, $email, $password);
            $user = $userModel->getUserByEmail($email);
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['user_name'] = $user["username"];
            redirect("/");
        } else {
            echo "[No deberia llegar hasta aca] las contraseñas no coinciden";
        }
    }

    static public function login()
    {
        $userModel = new UserModel;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['user-type'] ?? '';
        if ($userModel->existsEmail($email) && $userModel->validatePassword($email, $password)) {
            $user = $userModel->getUserByEmail($email);
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['user_name'] = $user["username"];
            redirect("/");
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            $redirection = $user_type == "enterprise" ? "/login-enterprise" : "/login-user";
            redirect("$redirection");
        }
    }

    static public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        redirect("/");
    }

    static public function getUserDashboard()
    {
        $userModel = new UserModel;
        $id = $_SESSION['user_id'] ?? '';
        if ($id != '') {
            $user = $userModel->find($id);
            view("user/dashboard", [
                "user" => $user,
            ]);
        } else {
            $_SESSION['error_message'] = "Debe iniciar sesión";
            redirect("/login-user");
        }
    }
}
