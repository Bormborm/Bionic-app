<?php

namespace Bormborm\Controller;

use Bormborm\Services\ValidationService;
use Bormborm\Services\DBHandlerService as DBH;

class AuthController extends MainController
{
    /**
     * @param null $validatedData
     * @return \Bormborm\Model\User
     * @throws \Exception
     */
    public function loginAction($validatedData = null)
    {
        $validator = new ValidationService();
        if (!empty($_POST['password']) && (!empty($_POST['email']))) {

            $validatedData = $validator->validatePassword($_POST['email'], $_POST['password']);
        }
        if ($validatedData)
        {
            $response = $this->getUserAction($validatedData['id']);
        } else throw new \Exception("User is not validated");
        return $response;
    }

    /**
     * @throws \Exception
     */
    public function registerAction()
    {
        //TODO: move validations to service

        if (isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['passwordRpt']) &&
            isset($_POST['name']) && ($_POST['password'] === $_POST['passwordRpt']))
        {
            $conn = DBH::getConnection();
            $stmt = $conn->prepare("INSERT INTO users (email, password, name, lastname) 
                        VALUES ('" . $_POST['email'] ."', " . ':password' . ", " . ':name' . ", " . ':lastname' . ");");
            $stmt->bindValue(':password', md5($_POST['password']));
            $stmt->bindValue(':name', $_POST['name']);
            $stmt->bindValue(':lastname', $_POST['lastname']);
            $stmt->execute();

            $this->loginAction();
        } else throw new \Exception("Registration not done");
    }
}
