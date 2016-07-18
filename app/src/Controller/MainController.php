<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;

class MainController
{

    public function getUserAction()
    {
        $user = new User();
        if (!($_GET['id']) == null) {
            $response = $user->getUserById($_GET['id']);
        }
        else {
            $response = $user->getUserById(1);
        }
        return $response;
    }

    public function getPostAction()
    {
        $post = new Post();
        if (!($_GET['id']) == null) {
        $response = $post->getAllByUserId($_GET['id']);
        }
        else {
            $response = $post->getAllByUserId(1);
        }
        return $response;
    }

    public function getCommentAction()
    {
        $comment = new Comment();
        if (!($_GET['id']) == null) {
            $response = $comment->getAllByUserId($_GET['id']);
        }
        else {
            $response = $comment->getAllByUserId(1);
        }
        return $response;
    }


}