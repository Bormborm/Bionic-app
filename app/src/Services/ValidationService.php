<?php

namespace Bormborm\Services;

use PDO;

class ValidationService extends DBHandlerService
{
    /**
     * @param $email
     * @param $password
     * @return array
     */
    public function validatePassword($email, $password)
    {
        $response = (self::query("SELECT id, password, login 
                              FROM users 
                              WHERE email='" . $email . "';"))
                              ->fetch();
        if ($response['password'] == md5($password))
        {
            $_SESSION['id'] = (int) $response['id'];
            $_SESSION['name'] = $response['login'];
        }
        return $response;
    }
}

