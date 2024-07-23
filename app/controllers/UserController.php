<?php
require_once MODELS . "UserModel.php";
class UserController
{
    static public function getUsers()
    {
        $userModel = new UserModel;
        $sqlTable = $userModel->getUsers();
        view("usersTable", ["sqlTable" => $sqlTable]);
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

    static public function logIn()
    {
        $userModel = new UserModel;
        $password = $_POST['input-password'];
        $email = $_POST['input-email'];
        $page = '';
        //
        //Tengo que programar la verifiacion del tipo de usuario
        //
        if ($userModel->userExists($email, $password)) {
            $page = 'homepage';
            include './' . $page . '.php';
        } else {
            echo "uma uma mama";
        }
    }

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
