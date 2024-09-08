<?php

namespace App\Services;

use  App\Models\UserModel;
use App\Models\BuyerModel;
use App\Models\SellerModel;


class AuthService
{

    protected $userModel;
    protected $sellerModel;
    protected $buyerModel;
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
        $this->userModel = new UserModel('admin'); // ESTO DEBERIA CAMBIAR Y ACEPTAR INSERTS EN USERS PARA GUEST
        $this->sellerModel = new SellerModel('admin');
        $this->buyerModel = new BuyerModel('admin');
    }

    // Método para autenticar a un usuario
    public function authenticate($email, $password)
    {
        // Obtener el usuario por email
        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            return null; // Usuario no encontrado
        }

        // Verificar la contraseña
        if (!$this->userModel->verifyPassword($password, $user['password_hash'])) {
            return null; // Contraseña incorrecta
        }

        return $user;
    }

    public function create($data = [])
    {
        $user = $this->userModel->create($data);
        // $data['role'] == 'seller'
        //     ? $this->sellerModel->update($data)
        //     : $this->buyerModel->update($data);

        return $user;
    }



    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['user']['role'] = 'guest';
        redirect("/");
    }

    public function getRole($userId)
    {
        return $this->userModel->getRole($userId);
    }
}
