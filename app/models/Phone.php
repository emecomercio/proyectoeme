<?php

namespace App\Models;

class Phone extends Model
{
    protected $table = 'phones';
    public $id;
    public $user_id;
    public $number;


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
