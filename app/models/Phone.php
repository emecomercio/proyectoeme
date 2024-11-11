<?php

namespace App\Models;

class Phone extends Model
{
    protected string $table = 'phones';
    public int|null $id;
    public int $user_id;
    public string $number;


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
