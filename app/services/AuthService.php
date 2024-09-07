<?php

namespace App\Services;

use  App\Models\UserModel;


class AuthService
{

    protected $userModel;
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
        $this->userModel = new UserModel('admin');
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
