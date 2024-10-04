<?php

namespace App\Models;

class Seller  extends User
{
    public $description;
    public $website;
    public $logo_url;
    public $mercadopago_account;
    public $paypal_account;


    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->table = 'sellers';
    }
}
