<?php

namespace Lib;

class Middleware
{
    public static function requireAuth()
    {
        return function () {
            if (getUser('role') === 'guest') {
                redirect('/login');
            }
        };
    }

    public static function checkRole($role)
    {
        return function () use ($role) {
            if (getUser('role') !== $role) {
                throw new \Exception("You do not have access to this resource.", 403);
            }
        };
    }
}
