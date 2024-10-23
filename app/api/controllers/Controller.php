<?php

namespace App\Api\Controllers;

use Lib\ErrorHandler;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Controller
{

    protected $secretKey;
    private $errorHandler;

    public function  __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->secretKey = $_ENV['JWT_SECRET'];
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->errorHandler->handle(function () use ($method, $arguments) {
                return call_user_func_array([$this, $method], $arguments);
            });
        }

        throw new \BadMethodCallException("El método {$method} no existe");
    }

    protected function respondWithSuccess($data = [], $message = 'Request was successful', $statusCode = 200, $token = null)
    {
        http_response_code($statusCode);

        header('Content-Type: application/json');

        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'statusCode' => $statusCode
        ];

        if ($token) {
            $response['token'] = $token;
        }

        echo json_encode($response);

        exit;
    }


    protected function respondWithError($message, $statusCode = 500)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        $response = [
            'status' => 'error',
            'message' => $message,
            'statusCode'  => $statusCode
        ];
        echo json_encode($response);
        exit;
    }

    protected function respondWithForbidden($message = "You do not have permission to access this resource")
    {
        http_response_code(403); // Código HTTP 403 Forbidden
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ]);
        exit;
    }

    protected function getInput()
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }

    protected function generateToken(User $user)
    {
        // Asegúrate de que la clave secreta esté definida
        if (empty($this->secretKey)) {
            throw new \Exception("La clave secreta no está definida");
        }

        $payload = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'iat' => time(), // Timestamp de creación
            'exp' => time() + 60 * 60 * 24 * 7 // Expira en 7 días
        ];

        $token = JWT::encode($payload, $this->secretKey, 'HS256');

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


    protected function verifyToken()
    {
        if (!isset($_COOKIE['jwt'])) {
            $this->respondWithError("No se encontró el token", 401);
        }

        $token = $_COOKIE['jwt'];

        $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

        return $decoded;
    }
}
