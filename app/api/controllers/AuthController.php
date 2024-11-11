<?php

namespace App\Api\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        $data = $this->getInput();
        $this->checkRequiredFields(['email', 'password'], $data);

        $user = $this->userModel->authenticate($data['email'], $data['password']);

        if (!$user) {
            throw new \Exception('Credenciales incorrectas', 401);
        }

        $this->generateToken($user);

        $this->respondWithSuccess(['user' =>  $user]);
    }

    public function logout()
    {
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
            throw new \Exception($msg, 400);
        }
    }

    private function generateToken(User $user)
    {
        // Asegúrate de que la clave secreta esté definida
        if (empty($_ENV["JWT_SECRET"])) {
            throw new \Exception("La clave secreta no está definida");
        }

        $payload = [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'username' => $user->username,
            'email' => $user->email,
            'iat' => time(), // Timestamp de creación
            'exp' => time() + 60 * 60 * 24 * 7 // Expira en 7 días
        ];

        $token = JWT::encode($payload, $_ENV["JWT_SECRET"], 'HS256');

        setcookie('jwt', $token, [
            'expires' => time() + 60 * 60 * 24 * 7,
            'path' => '/',
            'domain' =>  $_ENV["DOMAIN"],
            'secure' => $_ENV["DB_ENV"] === 'prod',
            'httponly' => true,
            'samesite' => 'Strict'
        ]);

        return $token;
    }

    public static function getToken()
    {
        if (isset($_COOKIE['jwt'])) {
            return JWT::decode($_COOKIE['jwt'], new Key($_ENV['JWT_SECRET'], 'HS256'));
        } else {
            throw new \Exception("There is no JWT token", 401);
        }
    }
}
