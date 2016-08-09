<?php

namespace Bormborm\Services;

use PDO;

class ValidationService extends DBHandlerService
{
    /**
     * @param $email
     * @param $password
     * @return bool|array
     */
    public function validatePassword($email, $password)
    {
        $result = false;
        $response = (self::query("SELECT id, password 
                              FROM users 
                              WHERE email='" . $email . "';"))
                              ->fetch();
        if ($response['password'] == md5($password))
        {
        $result = $response;
        }
        return $result;
    }
}
