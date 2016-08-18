<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;
use Bormborm\Services\ValidationService;

class MainController extends TemplateController
{
    //TODO: implement registration with twig templates. Make IndexAction work with / path

    public function indexAction()
    {
        if ($_GET['entity'] == 'logout')
        {
            unset($_SESSION);
            unset($_POST['email']);
            session_destroy();
            $render = $this->templater->render(
                'logout.twig',
                [
                    'loggedOut' => 'You are logged out'
                    // no data needed probably
                ]
            );
        } else
        {
            $render = $this->templater->render(
            'index.twig',
            [
                // no data needed probably
            ]
        );
        }
        return $render;
    }

    public function getUserAction($userId = null)
    {
        $id = ($userId) ? $userId : $_GET['id'];
        $user = new User();
        $response = $user->getUserById($id);
            echo $this->templater->render(
                'user.twig',
                [
                    'user' => $_SESSION['name'],
                    'id' => $response->getId(),
                    'name' => $response->getName(),
                    'lastname' => $response->getLastname(),
                    'posts' => $response->getPosts()
                ]
            );
        return $response;
    }

    public function getPostAction()
    {
        $post = new Post();
        if (!($_GET['id']) == null) {
        $response = $post->getAllByUserId($_GET['id']);
            var_dump($response);
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
