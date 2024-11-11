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
    public string $description;
    public string $website;
    public string $logo_url;
    public string $mercadopago_account;
    public string $paypal_account;
}
