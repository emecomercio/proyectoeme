<?php

namespace App\Models;

class Address extends Model
{
    protected $table = 'addresses';
    public int $id;
    public int $user_id;
    public string $street;
    public string $city;
    public string $state;
    public string $postal_code;
    public string $country;
    public string $type;
    public string $description;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFullAddress()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code . ', ' . $this->country;
    }
}
