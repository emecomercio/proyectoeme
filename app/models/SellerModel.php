<?php

namespace App\Models;

class SellerModel extends DatabaseModel
{

    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function update($data = [])
    {
        $description = $data['description'];
        $website = $data['website'];
        $logo_url = $data['logo-url'];
        $mercadopago_account = $data['mercadopago-account'];
        $paypal_account = $data['paypal-account'];
        $id = $data['id'];

        $query = "UPDATE sellers SET description = ?, website = ?, logo_url = ?, mercadopago_account = ?, paypal_account = ? WHERE id = ?";
        return $this->executeQuery($query, [$description, $website, $logo_url, $mercadopago_account, $paypal_account, $id], 'sssssi');
    }
}
