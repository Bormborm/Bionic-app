<?php

namespace Bormborm\Model;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var bool
     */
    private $isAuthorized;


    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


// TODO: Íå íğàâèòñÿ àâòîğèçàöèÿ.
// TODO: Ğàçîáğàòüñÿ ñ ıêçåìïëÿğàìè êëàññà User.
// TODO: Íå èñïîëüçóşòñÿ ñâîéñòâà êëàññà.

//    public function authoriseUser($password) {
//        $passHash = $this->dbh->query("SELECT password FROM users WHERE email = " . $this->email . "AND login = " . $this->login);
//        if (md5($password == $passHash)) {
//            $this->isAuthorized = true;
//        }
//    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}