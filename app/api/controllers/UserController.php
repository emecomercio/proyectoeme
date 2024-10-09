<?php

namespace App\Api\Controllers;

use mysqli_sql_exception;
use Exception;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Seller;
use stdClass;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
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
        } catch (mysqli_sql_exception $e) {
            $this->handleDatabaseError($e);
        } catch (Exception $e) {
            $this->handleException($e, "Error retrieving user");
        }
    }

    public function register()
    {
        return $this->handle(function () {
            $data = json_decode(file_get_contents('php://input'), true);

            $this->checkRequiredFields(['email', 'password', 'password-check', 'document-number', 'role', 'name', 'checkbox'], $data);

            if ($data['password'] != $data['password-check']) {
                $this->respondWithError("Passwords do not match", 400);
            }

            $model = $data['role'] == 'seller' ? Seller::class : Buyer::class;

            $user = new User();
            $user->email = $data['email'];
            $user->role =  $data['role'];
            $user->document_number = $data['document-number'];
            $user->name = $data['name'];
            $user->username = strtolower(str_replace(' ', '.', $user->name)) . '_' . $user->document_number;
            $user->password = bcrypt($data['password']);
            $user = $user->save();
            $user_id = $user->id;

            /**
             * @var Seller|Buyer $user
             */
            $user = new $model();
            $user = $user->create([
                'id' => $user_id,
            ]);
            $_SESSION['msg']['login'] = 'Registrado con éxito. Ingresa sesión para continuar';
            $this->respondWithSuccess($user);
        });
    }

    public function login()
    {
        return $this->handle(function () {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->checkRequiredFields(['email', 'password'], $data);

            $user = $this->userModel->authenticate($data['email'], $data['password']);

            if (!$user) {
                $this->respondWithError('Credenciales incorrectas', 401);
            }
            $_SESSION['user'] = json_encode($user);
            $this->respondWithSuccess($user, 200);
        });
    }

    public function logout()
    {
        return $this->handle(function () {
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





    /*
    public function validate($data = [], $rules = [])
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $ruleParts = explode('|', $rule);
            foreach ($ruleParts as $rulePart) {
                if ($rulePart == 'required' && empty($data[$field])) {
                    $errors[$field][] = 'The ' . $field . ' field is required.';
                } elseif ($rulePart == 'email' && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = 'The ' . $field . ' must be a valid email address.';
                } elseif ($rulePart == 'unique:users' && $this->userModel->where('email', $data[$field])->first()) {
                    $errors[$field][] = 'The ' . $field . ' has already been taken.';
                } elseif ($rulePart == 'min:8' && strlen($data[$field]) < 8) {
                    $errors[$field][] = 'The ' . $field . ' must be at least 8 characters.';
                }
            }
        }
        return $errors;
    }
    */
}
