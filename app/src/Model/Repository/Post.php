<?php

namespace Bormborm\Model\Repository;

class Post extends AbstractRepository
{
    public function getAllByUserId(int $id)
    {
        $conn = self::getConnection();
        $response = $conn->query("SELECT text FROM posts p LEFT JOIN users u ON u.id = p.user_id WHERE u.id = ". $id . ";");
        $comment =  $response->fetchAll();
        return $comment;

    }

}