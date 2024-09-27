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

    public function all()
    {
        $query = "SELECT
                    u.id,
                    u.role,
                    u.username,
                    u.email,
                    u.document_number,
                    u.active,
                    u.created_at,
                    u.updated_at,
                    u.name AS seller_name,
                    s.description AS seller_description,
                    s.website AS seller_website,
                    s.logo_url AS seller_logo_url,
                    s.mercadopago_account AS seller_mercadopago_account,
                    s.paypal_account AS seller_paypal_account
                FROM
                    users u
                INNER JOIN
                    sellers s ON u.id = s.id;";
        return $this->fetchAll($query);
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
