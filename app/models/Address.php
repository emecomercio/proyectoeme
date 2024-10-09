<?php

namespace App\Models;

class Address extends Model
{
    protected $table = 'addresses';
    public $id;
    public $user_id;
    public $street;
    public $city;
    public $state;
    public $postal_code;
    public $country;
    public $type;
    public $description;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFullAddress()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code . ', ' . $this->country;
    }
}
