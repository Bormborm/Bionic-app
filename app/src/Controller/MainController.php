<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;
use Bormborm\Services\ValidationService;

class MainController extends TemplateController
{

    private $pr;

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

        $id = ($userId) ? $userId : (int) $_GET['id'];
        if ($val->checkUserExists((int) $id)) {

            $userRep = new User();
            $user = $userRep->getUserById($id);
            echo $this->templater->render(
                'user.twig',
                [
                    'user' => $_SESSION['name'],
                    'id' => $_SESSION['id'],//$user->getId(),
                    'name' => $user->getName(),
                    'lastname' => $user->getLastname(),
                    'posts' => $user->getPosts()
                ]
            );
        } else throw new \Exception("user doesn't exist");
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

    public function addPostAction()
    {
        $pr = new Post();
        if (!empty($_POST['postText'])) {
            $pr->addNewPost($_POST['postText'], $_SESSION['id']);
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
        if (!empty($_POST['addedComment']) && (!empty($_POST['postId']))) {
            $postId = (int)$_POST['postId'];
            $commentRepository->addNewCommentByUserId($_SESSION['id'], $_POST['addedComment'], $postId);
        }
    }

    public function deleteCommentAction()
    {
        if (!empty($_POST['deleteComment'])) {
            $id = (int)$_POST['deleteComment'];
            $commentRepository->deleteComment($id);
        }
    }

}

