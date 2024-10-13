<?php

namespace App\Api\Controllers;

use App\Models\User;
use Error;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function login()
    {
        return $this->handle(function () {
            $data = $this->getInput();
            $this->checkRequiredFields(['email', 'password'], $data);

            $user = $this->userModel->authenticate($data['email'], $data['password']);

            if (!$user) {
                $this->respondWithError('Credenciales incorrectas', 401);
            }

            $this->generateToken($user);

            $_SESSION['user'] = json_encode($user);

            $this->respondWithSuccess(['user' =>  $user]);
        });
    }

    public function logout()
    {
        return $this->handle(function () {

            setcookie('jwt', '', [
                'expires' => time() - 3600,
                'path' => '/',
                'domain' => $_ENV["DOMAIN"],
                'secure' => $_ENV["DB_ENV"] === 'prod',
                'httponly' => true,
                'samesite' => 'Strict'
            ]);

            session_regenerate_id(true);


            session_unset();
            session_destroy();
            $_SESSION['msg']['login'] = 'Sesión cerrada con éxito';
            $this->respondWithSuccess('Logged out');
        });
    }

    private function checkRequiredFields(array $fields, $data)
    {
        $missingFields = [];
        foreach ($fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            $msg = 'The following fields are required: ' . implode(', ', $missingFields);
            $this->respondWithError($msg, 400);
        }
    }
}
