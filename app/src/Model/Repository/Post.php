<?php

namespace Bormborm\Model\Repository;

use Bormborm\Services\DBHandlerService;
use Bormborm\Model\Post as PostModel;

class Post extends DBHandlerService
{
    /**
     * @param int $id
     * @return PostModel []
     */
    public function getAllByUserId(int $id)
    {
        $response = self::query("SELECT p.text, p.date, p.id , u.name
                                  FROM posts p LEFT JOIN users u
                                  ON u.id = p.user_id 
                                  WHERE u.id = " . $id . "
                                  ORDER BY id DESC;");
        $posts = $response->fetchAll();
        foreach ($posts as $postModel => $postArray) {
            $allPostComments = (new Comment())->getAllPostComments($postArray['id']);
            $posts[$postModel] =
                (
                new PostModel(
                    $postArray['id'],
                    $postArray['text'],
                    $postArray['date'],
                    $postArray['name']
                )
                )->setComments($allPostComments);
        }
        return $posts;
    }

    public function addNewPost(string $postText, int $id)
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("INSERT INTO posts 
                                (text, user_id, date) 
                                VALUES (:postText, $id, NOW())");
        $stmt->bindValue(':postText', $postText);
        $stmt->execute();
    }

    public function deletePost(int $id)
    {
        $response = self::query("DELETE FROM posts WHERE id=" . $id . ";");
        return $response;
    }
}

