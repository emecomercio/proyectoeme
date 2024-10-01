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

    public function index()
    {
        // $users = $this->userModel->where("email like '%@example.com%'")->orderBy('name', 'asc')->limit(10)->get();
        $sql = "SELECT id, name, email  FROM users WHERE id < ?";
        $raw = $this->userModel->rawQuery($sql,  [5], 'i');
        return dd($raw[0]->name);

        $users = $this->userModel->select('name', 'email')->where('id',  '<', 10)->get();
        foreach ($users as $user) {
            dd($user, true);
        }
    }

    public function phones()
    {
        $user = new User();
        $userDetails = $user->find(57);
        $userPosts = $userDetails->phones();
        dd($userPosts);
    }
}
