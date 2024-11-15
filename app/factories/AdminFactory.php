<?php

namespace App\Factories;

use App\Models\User;

class AdminFactory
{

    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createAdmin($username, $email, $document_number, $name, $password)
    {
        $this->userModel->create([
            'role' => 'admin',
            'username' => $username,
            'email' => $email,
            'document_number' => $document_number,
            'name' => $name,
            'password' => bcrypt($password),
        ]);
    }
}
