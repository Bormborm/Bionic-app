<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;

class MainController extends TemplateController
{

    public function indexAction()
    {
        if ($_GET['entity'] == 'logout') {
            unset($_SESSION);
            unset($_POST['email']);
            session_destroy();
            $render = $this->templater->render(
                'logout.twig',
                [
                    'loggedOut' => 'You are logged out'
                ]
            );
        } else $render = $this->templater->render('index.twig',[]);

        return $render;
    }

    /**
     * @param null $userId
     * @return \Bormborm\Model\User
     */
    public function getUserAction($userId = null)
    {
        $id = ($userId) ? $userId : (int) $_GET['id'];
        $userRep = new User();
        $user = $userRep->getUserById($id);
        echo $this->templater->render(
            'user.twig',
            [
                'user' => $_SESSION['name'],
                'id' => $user->getId(),
                'name' => $user->getName(),
                'lastname' => $user->getLastname(),
                'posts' => $user->getPosts()
            ]
        );
        return $user;
    }

    public function getPostAction()
    {
        $post = new Post();
        if (!($_GET['id']) == null) {
            $response = $post->getAllByUserId((int) $_GET['id']);
        } else {
            $response = $post->getAllByUserId(1);

        }
        return $response;
    }

    public function getCommentAction()
    {
        $comment = new Comment();
        if (!($_GET['id']) == null) {
            $response = $comment->getAllByUserId($_GET['id']);
        } else {
            $response = $comment->getAllByUserId(1);
        }
        return $response;
    }
}

