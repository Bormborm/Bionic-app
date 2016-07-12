<?php

namespace Bormborm\Model\Repository;
require_once 'AbstractRepository.php';
use Bormborm\Model\User as UserModel;

class User extends AbstractRepository
{

    /**
     * @param int $id
     * @return UserModel
     */
    public static function getUserById($id)
    {
        $conn = self::getConnection();
        $response = $conn->query("SELECT name FROM users WHERE id = ". $id);
        $user =  $response->fetchAll();
        return $user;

    }

    public function getAll()
    {
        $conn = self::getConnection();

        $response = $conn->query("SELECT * FROM users");
        $users = $response->fetchAll();

        foreach ($users as $user => $userArray) {
            $users[$user] = new UserModel($userArray['id'], $userArray['name']);
        }
        return $users;
    }


}