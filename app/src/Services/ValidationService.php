<?php

namespace Bormborm\Services;

class ValidationService extends DBHandlerService
{
    /**
     * @param $email
     * @param $password
     * @return array
     * @throws \Exception
     */
    public function validatePassword($email, $password)
    {
        $response = (self::query("SELECT id, password, name
                              FROM users
                              WHERE email='" . $email . "';"))
            ->fetch();
        if ($response['password'] === md5($password)) {
            $_SESSION['id'] = (int)$response['id'];
            $_SESSION['name'] = $response['name'];
        } else {
            throw new \Exception("Password is wrong");
        }
        return $response;
    }
}

