<?php

namespace Bormborm\Model\Repository;

class Comment extends AbstractRepository
{
    public function getAllByUserId(int $id)
    {
        $conn = self::getConnection();
        $response = $conn->query("SELECT * FROM users u LEFT JOIN comments c ON u.id = c.user_id WHERE u.id = ". $id . ";");
        $comment =  $response->fetch();
        return $comment;

    }

}