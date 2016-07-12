<?php

//TODO: Class is not used anymore yet;

namespace Bormborm\Model;

class DB
{
    private static $user = 'olympus';
    private static $dbpass = 'odin3306';
    protected $dbh;
    private static $dsn = 'mysql:host=localhost;dbname=pantheon';

    public function __construct()
    {
        try {
            $this->dbh = new \PDO(self::$dsn, self::$user, self::$dbpass);
            $this->dbh->exec("SET NAMES 'UTF8'");
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "connected to db pantheon";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

// TODO: methods insertUser, checkEmail, checkLogin must be in other class OR NOT.

    /**
     * @param $email
     * @return bool
     */
    public function userEmailExists($email) {
        $selectQuery = "SELECT id FROM users WHERE email = $email";
        $result = ($this->dbh->query($selectQuery))? true : false;
        return $result;
    }

    /**
     * @param $login
     * @return bool
     */
    public function userLoginExists($login) {
        $selectQuery = "SELECT id FROM users WHERE  login = $login";
        $result = ($this->dbh->query($selectQuery))? true : false;
        return $result;
    }

    /**
     * @param $email
     * @param $login
     * @param $password
     * @return bool
     */
    public function insertUser($email, $login, $password)
    {
        if ($this->userEmailExists($email)) {
            // $errMsg = "email exists";
            $result = false;
        } elseif ($this->userLoginExists($login)) {
            // $errMsg = "login exists";
            $result = false;
        } else {
            $passwordHash = md5($password);
            $insertQuery = 'INSERT INTO users (email, login, password)
                VALUES (:email, :login, :password)';
            try {
                $prep = $this->dbh->prepare($insertQuery);
                $prep->bindParam(':email', $email);
                $prep->bindParam(':login', $login);
                $prep->bindParam(':password', $passwordHash);
                $prep->execute();
                $result = true;
            } catch (\PDOException $e) {
                // $errMsg = "exception :" . $e->getMessage();
                $result = false;
            }
        }
        return $result;
    }
}
