<?php

namespace App\Models;

class BuyerModel extends DatabaseModel
{

    protected $userModel;

    public function __construct($role)
    {
        parent::__construct($role);
        $this->userModel = new UserModel($role);
    }

    public function update($data = [])
    {
        $id = $data['id'];
        $birthdate = $data['birthdate'] ?? null;
        $query = "UPDATE buyers SET birthdate = ? WHERE id = ?";
        return $this->executeQuery($query, [$birthdate, $id], 'si');
    }
}
