<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\Comment;
use Bormborm\Model\Repository\Post;
use Bormborm\Model\Repository\User;

class MainController extends TemplateController
{
    //TODO: implement registration with twig templates. Make IndexAction work with / path

    public function indexAction()
    {
        return $this->templater->render(
            'register.twig',
            [
                // no data needed probably
            ]
        );
    }

    public function getUserAction()
    {
        $user = new User();
        if (($_GET['id']) == null) {
            $response = $user->getAll();
            //$this->templater->render('users.twig', $response);
        }
        else {
            $response = $user->getUserById($_GET['id']);
            echo $this->templater->render(
                'user.twig',
                [
                    'id' => $response->getId(),
                    'name' => $response->getName(), //string
                    'lastname' => $response->getLastname(), //string
                    'posts' => $response->getPosts() //array of post objects with comments
                ]
            );
         //  echo "<pre>"; var_dump($response); echo "</pre>"; die();
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