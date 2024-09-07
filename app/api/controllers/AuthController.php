<?php

namespace App\Api\Controllers;

use Exception;
use App\Services\AuthService;

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
}
