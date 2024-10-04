<?php

namespace App\Models;

/**
 * @property int $id
 * @property string $role
 * @property string $username
 * @property string $email
 * @property int $document_number
 * @property string $name
 * @property string $password
 * @property int $active
 */

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

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->table = 'users';
        parent::__construct($data);
    }


    /**
     * @param boolean $state
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
