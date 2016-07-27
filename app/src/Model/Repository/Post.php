<?php

namespace Bormborm\Model\Repository;

use Bormborm\Services\DBHandlerService;

class Post extends DBHandlerService
{
    public function getAllByUserId(int $id)
    {
        $conn = self::getConnection();
        $response = $conn->query("SELECT text, date FROM posts p LEFT JOIN users u ON u.id = p.user_id WHERE u.id = ". $id . ";");
        $comment =  $response->fetchAll();
        return $comment;

    }

}