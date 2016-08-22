<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;
use Bormborm\Services\ValidationService;

class MainController extends TemplateController
{
    /**
     * @return string
     */
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

        if (isset($_SESSION['id']))
        {
            $this->getUserAction($_SESSION['id']);
        }
        return $render;
    }

    /**
     * @param null $userId
     * @return \Bormborm\Model\User
     * @throws \Exception
     */
    public function getUserAction($userId = null)
    {
        $val = new ValidationService();

        $id = ($userId) ? $userId : $_GET['id'];
        if ($val->checkUserExists((int) $id)) {

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
        } else throw new \Exception("user doesn't exist");
        return $user;
    }

    public function addPostAction()
    {
        $pr = new Post();
        if (!empty($_POST['postText'])) {
            $pr->addNewPost($_POST['postText'], $_SESSION['id']);
            unset($_POST);
        }
        $this->getUserAction();
    }

    public function deletePostAction()
    {
        $pr = new Post();
        if (!empty($_POST['deletePost'])) {
            $pr->deletePost((int) $_POST['deletePost']);
        }
        $this->getUserAction();
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

    public function addCommentAction()
    {
        $cr = new Comment();
        if (!empty($_POST['addedComment']) && (!empty($_POST['postId']))) {
            $cr->addNewCommentByUserId($_SESSION['id'], $_POST['addedComment'], (int) $_POST['postId']);
            unset($_POST);
        }
        $this->getUserAction($_GET['id']);
    }

    public function deleteCommentAction()
    {
        $cr = new Comment();
        if (!empty($_POST['deleteComment'])) {

            $cr->deleteComment((int) $_POST['deleteComment']);
        }
        $this->getUserAction($_GET['id']);
    }

    // Not used.
    public function getPostAction()
    {
        $post = new Post();
        if (!($_GET['id']) == null) {
            $response = $post->getAllByUserId((int) $_GET['id']);
        } else {
            $response = $post->getAllByUserId(1);
        }
        $this->templater->render(
            'homepage.twig',
            [
                'user' => $_SESSION['name'],
                'posts' => $response
            ]
        );
        return $response;
    }

}

