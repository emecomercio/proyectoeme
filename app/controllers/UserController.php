<?php

namespace App\Controllers;

use App\Models\Phone;
use App\Models\User;

class UserController extends Controller
{
    protected  $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index($state = null)
    {
        $user = new User([
            "name" =>  "John Doe",
            "email" =>  "john@example.com",
            "password"  =>  "password"
        ]);
        return dd($user);
        $users = $state == null ? $user->all() : $user->all($state ===  'true' ? 1 : 0);
        $users = $user->find(1);
        dd($users);
    }

    public function all()
    {
        $users = new User();
        $users = $users->all();
        dd($users);
    }

    public function phones($id)
    {
        $user = new User();
        $userDetails = $user->find($id);
        return $userDetails->phones();
    }
}
