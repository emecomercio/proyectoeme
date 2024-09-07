<?php

namespace App\Api\Controllers;

use Exception;

class BaseController
{
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
        // Verificar si es un error de permiso denegado (error codes: 1044, 1142)
        if (in_array($e->getCode(), [1044, 1142])) {
            error_log($e->getMessage());
            // Mostrar un mensaje personalizado al usuario
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource.'
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
        } else {
            // Si es otro tipo de error, puedes manejarlo de forma diferente
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occurred.'
            ]);
        }
        exit;
    }

    protected function handleException(Exception $e, $message = "An error occurred")
    {
        // Log the exception (puedes integrar aquí un logger si es necesario)
        error_log($e->getMessage());

        // Retorna una respuesta de error
        $this->respondWithError($message, 500);
    }
}
