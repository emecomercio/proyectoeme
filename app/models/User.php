<?php

namespace App\Models;

class User extends Model
{
    public $id;
    public $role;
    public $username;
    public $email;
    public $document_number;
    public $name;
    public $password;
    public $active;

    public function __construct($data = [])
    {
        $this->table = 'users';
        parent::__construct($data);
    }


    /**
     * Undocumented function
     *
     * @param boolean $state
     * False for inactive users
     * @return void
     * 
     */
    public function all($state = null)
    {
        if ($state == null) {
            return $this->select('*')->get();
        }
        return $this->select('*')->where('active', '=', $state)->get();
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'user_id');
    }
}
