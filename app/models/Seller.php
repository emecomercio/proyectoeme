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
    protected string $table = 'sellers';
    public string|null $description;
    public string|null $website;
    public string|null $logo_url;
    public string|null $mercadopago_account;
    public string|null $paypal_account;
}
