<?php

namespace Bormborm\Services;


class ValidationService extends DBHandlerService
{
    /**
     * @param $email
     * @return bool
     */
    public function validateEmail($email)
    {
        return (filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) ? true : false;
    }

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

    public function checkUserExists($value)
    {
        $emailQuery = "SELECT * FROM users WHERE email = '$value'";
        $idQuery = "SELECT * FROM users WHERE id = $value";
        if (gettype($value) == 'string') {
            $query = $emailQuery;
        } elseif (gettype($value) == 'integer') {
            $query = $idQuery;
        } else throw new \Exception("not a value passed to uservalidator");

        $rr = (self::query($query)->fetch()) ? true : false;

//        $conn = self::getConnection();
//        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ':email';");
//        $stmt->bindValue(':email', $email);
//        $stmt->execute();
        return $rr;

    }
}

