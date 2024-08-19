<?php
require_once MODELS . "UserModel.php";
class UserController
{
    static public function getUsers()
    {
        $userModel = new UserModel;
        $users = $userModel->getUsers();
        view("usersTable", [
            "users" => $users,
            "title" => "Usuarios"
        ]);
    }
    static public function addUser()
    {
        $userModel = new UserModel;
        $user_type = $_POST['input-type'];
        $fullname = $_POST['input-fullname'];
        $password = $_POST['input-password'];
        $email = $_POST['input-email'];
        $birthdate = $_POST['input-birthdate'];
        $userModel->addUser($user_type, $fullname, $email, $password, $birthdate);
        include "../public/registro_exitoso.html";
    }

    static public function register()
    {
        $userModel = new UserModel;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['user-type'] ?? '';
        $password_check = $_POST['password-check'];

        if ($userModel->userExists($email)) {
            $_SESSION['error'] = $user_type == "enterprise" ? "Ya existe una empresa registrada con ese correo" : "Ya existe un usuario con ese correo";
            $redirection = $user_type == "enterprise" ? "/register-enterprise" : "/register-user";
            redirect("$redirection");
        }

        if ($password == $password_check) {
            $userModel->register($email, $password);
            $user = $userModel->getUserByEmail($email);
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['user_name'] = "Marcos";
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
        if ($userModel->userExists($email) && $userModel->validatePassword($email, $password)) {
            $_SESSION['user_id'] = $userModel->getUserByEmail($email)["id"];
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
            $user = $userModel->getUserById($id);
            view("user/dashboard", [
                "user" => $user,
            ]);
        } else {
            redirect("/login-user");
        }
    }

    // Las de abajo no se usan aun

    static public function updateUser()
    {
        $userModel = new UserModel;
        $id = $_POST['input-id'];
        $user = $userModel->getUserById($id);
        include "../app/usuarios/views/updateUser.php";
    }

    static public function  saveUserUpdate()
    {
        $userModel = new UserModel;
        $id = $_POST['input-id'];
        $user_type = $_POST['input-type'];
        $fullname = $_POST['input-fullname'];
        $email = $_POST['input-email'];
        $birthdate = $_POST['input-birthdate'];
        $password = isset($_POST['input-password']) ? $_POST['input-password'] : null;
        $userModel->updateUser($id, $user_type, $fullname, $password, $email, $birthdate);
        static::getUsers();
    }

    static public function deleteUser()
    {
        $userModel = new UserModel;
        $id = $_POST['input-id'];
        $userModel->deleteUser($id);
        static::getUsers();
    }
}
