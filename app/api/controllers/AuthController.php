<?php

namespace App\Api\Controllers;

use Exception;
use App\Services\AuthService;
use mysqli_sql_exception;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct($role)
    {
        $this->authService = new AuthService($role);
    }

    public function login()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = $this->authService->authenticate($data['email'], $data['password']);

            if (!$user) {
                $this->respondWithError('Credenciales incorrectas', 401);
            }
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['role'] = $user['role'];
            $this->respondWithSuccess($user, 200);
        } catch (Exception $e) {
            $this->handleException($e, "Error logging in");
        }
    }

    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            // Validar campos obligatorios
            $requiredFields = ['email', 'password', 'document-number', 'role', 'name'];
            $missingFields = [];

            // Recorrer los campos requeridos y verificar si están vacíos o nulos
            foreach ($requiredFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    $missingFields[] = $field;
                }
            }

            // Si faltan campos, responde con un error
            if (!empty($missingFields)) {
                $msg = 'The following fields are required: ' . implode(', ', $missingFields);
                $this->respondWithError($msg, 400); // Devuelve un error 400
            }

            // Crear el usuario si todos los campos son válidos
            $user = $this->authService->create($data);
            $_SESSION['msg']['login'] = 'Registrado con exito. Ingresa sesion para continuar';
            $this->respondWithSuccess($user, 201);
        } catch (mysqli_sql_exception $e) {
            // Errores específicos de la base de datos
            $this->handleDatabaseError($e, $data);
        } catch (Exception $e) {
            // Errores generales
            $this->handleException($e, "Error creating user");
        }
    }
}
