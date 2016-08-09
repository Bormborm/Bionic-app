<?php

namespace Bormborm\Model\Repository;



use Bormborm\Model\User as UserModel;
use Bormborm\Services\DBHandlerService;

class User extends DBHandlerService
{
    //TODO: add posts and comments to single user

    /**
     * @param int $id
     * @return UserModel
     */
    public static function getUserById(int $id)
    {
        $conn = self::getConnection();
        $resp = $conn->query("SELECT * FROM users WHERE id = ". $id . ";");
        $col =  $resp->fetch();
        $user = new UserModel($id, $col['name'], $col['lastname'], $col['email'], $col['password']);
        $user->setPosts((new Post())->getAllByUserId($id));

        return $user;
    }

    /**
     * @return array
     */
    public function getAll() :array
    {
        $conn = self::getConnection();

        $response = $conn->query("SELECT * FROM users WHERE 1;");
        $users = $response->fetchAll();

        foreach ($users as $user => $userArray) {
            $users[$user] = new UserModel(
                $userArray['id'],
                $userArray['name'],
                $userArray['lastname'],
                $userArray['email'],
                $userArray['password']
            );
        }
        return $users;
    }
}