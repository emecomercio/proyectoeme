<?php

namespace App\Models;

class Address extends Model
{
    protected string $table = 'addresses';
    public int|null $id;
    public int $user_id;
    public string|null $street;
    public string|null $city;
    public string|null $state;
    public string|null $postal_code;
    public string|null $country;
    public string $type = "home";
    public string|null $description;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFullAddress()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postal_code . ', ' . $this->country;
    }
}
