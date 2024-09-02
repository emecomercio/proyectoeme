<?php

namespace App\Services;

use App\Models\UserModel;

class UserService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    public function all()
    {
        return $this->userModel->all();
    }

    public function allActive()
    {
        return $this->userModel->allActive();
    }

    public function allInactive()
    {
        return $this->userModel->allInactive();
    }

    public function find($id)
    {
        return $this->userModel->find($id);
    }

    public function create(array $data = [])
    {
        return $this->userModel->create($data);
    }

    public function updatePhoneNumber($id, $phoneNumber)
    {
        return $this->userModel->updatePhoneNumber($id, $phoneNumber);
    }

    public function updateUsername($id, $username)
    {
        return $this->userModel->updateUsername($id, $username);
    }

    public function activate($id)
    {
        return $this->userModel->activate($id);
    }

    public function desactivate($id)
    {
        return $this->userModel->desactivate($id);
    }

    public function validatePassword($email, $password)
    {
        return $this->userModel->validatePassword($email, $password);
    }

    public function existsEmail($email)
    {
        return $this->userModel->existsEmail($email);
    }
}
