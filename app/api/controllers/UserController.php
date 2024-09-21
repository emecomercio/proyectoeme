<?php

namespace App\Api\Controllers;

use Exception;
use mysqli_sql_exception;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        try {
            $users = $this->userModel->all();
            $this->respondWithSuccess($users);
        } catch (mysqli_sql_exception $e) {
            // Errores especificos de la BD
            $this->handleDatabaseError($e);
        } catch (Exception $e) {
            // Errores generales
            $this->handleException($e, "Error retrieving users");
        }
    }


    public function find($id)
    {
        try {
            $user = $this->userModel->find($id);

            if (!$user) {
                $this->respondWithError("User not found", 404);
            } else {
                $this->respondWithSuccess($user);
            }
        } catch (Exception $e) {
            $this->handleException($e, "Error retrieving user");
        }
    }
}
