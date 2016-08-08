<?php

namespace Bormborm\Model\Repository;

use Bormborm\Services\DBHandlerService;
use Bormborm\Model\Comment as CommentModel;

class Comment extends DBHandlerService
{
    public function getAllByUserId(int $id)
    {
        $response = self::query("SELECT u.name, c.text, c.date 
                                 FROM users u LEFT JOIN comments c 
                                 ON u.id = c.user_id 
                                 WHERE u.id = ". $id . ";");
        $comment =  $response->fetchAll();
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

    public function getAllPostComments(int $postId)
    {
        $conn = self::getConnection();
        $response = $conn->query("SELECT u.name, c.text, c.date 
                                  FROM comments c LEFT JOIN users u 
                                  ON c.user_id = u.id 
                                  WHERE c.post_id = " . $postId . ";");
        $comments = $response->fetchAll();
        foreach ($comments as $comment => $commentArray) {
            $comments[$comment] = (new CommentModel())
                                   ->setUserName($commentArray['name'])
                                   ->setText($commentArray['text'])
                                   ->setDate($commentArray['date']);
        }
        return $comments;
    }
}
