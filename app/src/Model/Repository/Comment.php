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
    public function addNewCommentByUserId(int $id, string $text)
    {
        //TODO: if the post is commented, need to insert postID.

        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO comments VALUES (,':text',$id,,NOW())");
        $stmt->bindValue(':text',$text);
        $stmt->execute();
    }

}