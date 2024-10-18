<?php

namespace Lib;

class Middleware
{
    public static function requireAuth()
    {

        return function () {
            if (getUser('role') === 'guest') {
                //agregar msg
                header('Location: /login');
                exit();
            }
        };
    }

    public static function checkRole($role)
    {
        return function () use ($role) {
            $userRole = getUser('role');
            if ($userRole !== $role) {
                http_response_code(403);
                die("You do not have access to this resource.");
            }
        };
    }
}
