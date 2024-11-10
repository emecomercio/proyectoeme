<?php

namespace App\Api\Controllers;

class Controller
{
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

    protected function getInput()
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }
}
