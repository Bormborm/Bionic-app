<?php

namespace Bormborm\Model\Repository;

use Bormborm\Services\DBHandlerService;
use Bormborm\Model\Comment as CommentModel;

class Comment extends DBHandlerService
{
    public function getAllByUserId(int $id)
    {
        $response = self::query("SELECT u.name, c.text, c.date, c.id 
                                 FROM users u LEFT JOIN comments c 
                                 ON u.id = c.user_id 
                                 WHERE u.id = ". $id . "
                                 GROUP BY c.date;");
        $comment =  $response->fetchAll();
        $comment['id'] = (int) $comment['id'];
        return $comment;

    }
    public function addNewCommentByUserId(int $id, string $text, int $post_id)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO comments 
                                (text, user_id, post_id, date)
                                VALUES (:text, $id, $post_id, NOW())");
        $stmt->bindValue(':text',$text);
        $stmt->execute();
    }

    public function getAllPostComments(int $postId)
    {
        $response = self::query("SELECT u.name, c.text, c.date, c.id, c.user_id 
                                  FROM comments c LEFT JOIN users u 
                                  ON c.user_id = u.id 
                                  WHERE c.post_id = " . $postId . ";");
        $comments = $response->fetchAll();
        foreach ($comments as $commentModel => $commentArray) {
            $comments[$commentModel] = (new CommentModel())
                ->setUserName($commentArray['name'])
                ->setText($commentArray['text'])
                ->setDate($commentArray['date'])
                ->setId((int) $commentArray['id'])
                ->setUserId((int) $commentArray['user_id']);
        }
        return $comments;
    }
    public function deleteComment(int $id)
    {
        $response = self::query("DELETE FROM comments WHERE id=" . $id . ";");
        return $response;
    }
}
