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
        $conn = self::getConnection();
        $response = $conn->query("SELECT p.text, p.date, p.id
                                  FROM posts p LEFT JOIN users u
                                  ON u.id = p.user_id 
                                  WHERE u.id = ". $id . "
                                  ORDER BY id DESC;");
        $posts =  $response->fetchAll();
        foreach ($posts as $post => $postArray) {
            $comments = (new Comment())
                ->getAllPostComments($postArray['id']);
            $posts[$post] = (new PostModel($postArray['id'], $postArray['text'], $postArray['date']))
                ->setComments($comments);
        }
        return $posts;

    }

}