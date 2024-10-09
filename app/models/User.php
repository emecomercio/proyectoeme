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
    protected $table = 'users';
    public $id;
    public $role;
    public $username;
    public $email;
    public $document_number;
    public $name;
    public $password;
    public $active;

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

    public function authenticate($email, $password)
    {
        $exception = new \Exception('Credenciales incorrectas');

        $userId = $this->exists('email', $email, true);

        if ($userId) {
            $user = $this->find($userId);
            if ($user && password_verify($password, $user->password)) {
                return $user;
            }
        }

        throw $exception;
    }


    /**
     * Finds an instance of the model by its primary key.
     *
     * This method dynamically checks the model's table to determine if it 
     * should perform a normal find (for User) or a JOIN (for Buyer or Seller).
     *
     * @param mixed $pk The value of the primary key to search for.
     * @return static|null Returns an instance of the model if found, or null if not.
     */
    public function find($pk)
    {
        if ($this->table  == 'users') {
            return parent::find($pk);
        } else {
            $result = $this
                ->join('users', 'users.id', "{$this->table}.id")
                ->where('users.id', '=',  $pk)
                ->get();
            return $result ? $result[0] : null;
        }
    }
}
