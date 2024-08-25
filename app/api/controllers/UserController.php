<?php

namespace App\Api\Controllers;

use App\Services\UserService;

class UserController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        // Obtén todos los usuarios desde el modelo
        $users = $this->userService->all();

        // Configura el encabezado para indicar que el contenido es JSON
        header('Content-Type: application/json');

        // Envía los datos en formato JSON
        echo json_encode($users);
    }

    public function find($id)
    {
        $user = $this->userService->find($id);

        header('Content-Type: application/json');

        echo json_encode($user);
    }
}
