<?php

namespace App\Models;

/**
 * @property string $description
 * @property string $website
 * @property string $logo_url
 * @property string $mercadopago_account
 * @property string $paypal_account
 */

class Seller  extends User
{
    protected $table = 'sellers';
    public $description;
    public $website;
    public $logo_url;
    public $mercadopago_account;
    public $paypal_account;
}
