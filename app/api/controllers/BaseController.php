<?php

namespace App\Api\Controllers;

use Exception;
use mysqli_sql_exception;

class BaseController
{
    protected function handle(callable $f, string $m = "An error occurred")
    {
        try {
            return  $f();
        } catch (mysqli_sql_exception $e) {
            $this->handleDatabaseError($e);
        } catch (Exception $e) {
            $this->handleException($e, $m);
        }
    }

    protected function respondWithSuccess($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
        exit;
    }

    protected function respondWithError($message, $statusCode = 500)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ]);
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

    protected function handleDatabaseError($e)
    {
        if (in_array($e->getCode(), [1044, 1142])) {
            error_log($e->getMessage());
            // Mostrar un mensaje personalizado al usuario
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource. You are ' . getUserRole()
            ]);
        } elseif (in_array($e->getCode(), [1062])) {
            error_log($e->getMessage());
            $this->respondWithError($e->getMessage(), 400);
        } elseif (in_array($e->getCode(), [1452])) {
            error_log($e->getMessage());
            $this->respondWithError('Foreign key constraint fails', 400);
        } elseif (in_array($e->getCode(), [1054])) {
            error_log($e->getMessage());
            $this->respondWithError('Unknown column', 400);
        } elseif (in_array($e->getCode(), [1364])) {
            error_log($e->getMessage());
            $this->respondWithError('Field does not have a default value', 400);
        } elseif (in_array($e->getCode(), [1064])) {
            error_log($e->getMessage());
            $this->respondWithError('You have an error in your SQL syntax', 400);
        } elseif (in_array($e->getCode(), [1146])) {
            error_log($e->getMessage());
            $this->respondWithError('Table does not exist', 400);
        } elseif (in_array($e->getCode(), [1366])) {
            error_log($e->getMessage());
            $this->respondWithError('Incorrect value for field', 400);
        } elseif (in_array($e->getCode(), [1451])) {
            error_log($e->getMessage());
            $this->respondWithError('Cannot delete or update a parent row', 400);
        } elseif (in_array($e->getCode(), [1048])) {
            error_log($e->getMessage());
            $this->respondWithError($e->getMessage(), 400);
        } else {
            // Si es otro tipo de error, se muestra  un mensaje genérico
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Code: ' . $e->getCode() . ' ' . $e->getMessage()
            ]);
        }
        exit;
    }

    protected function handleException(Exception $e, $message = "An error occurred")
    {
        // Log the exception
        error_log($e->getMessage());

        // Retorna una respuesta de error
        $this->respondWithError($message, 500);
    }
}
