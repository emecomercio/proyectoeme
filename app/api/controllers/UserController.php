<?php

namespace App\Api\Controllers;

use App\Models\UserModel;

class UserController
{
    static public function index()
    {
        // Obtén todos los usuarios desde el modelo
        $users = UserModel::all();

        // Configura el encabezado para indicar que el contenido es JSON
        header('Content-Type: application/json');

        // Envía los datos en formato JSON
        echo json_encode($users);
    }
}
