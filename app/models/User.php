<?php

namespace App\Models;

class User extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'user_id');
    }
}
