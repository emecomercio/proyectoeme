<?php

namespace App\Models;

class Phone extends Model
{
    protected $table = 'phones';
    public int $id;
    public int $user_id;
    public string $number;


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
