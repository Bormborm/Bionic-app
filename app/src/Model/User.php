<?php

namespace Bormborm\Model;

use Bormborm\Model\Comment;
use Bormborm\Model\Post;

class User
{
    //TODO: check Post and Comment getters and setters

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var Comment []
     */
    private $comments;

    /**
     * @var Post []
     */
    private $posts;

    //TODO: make constructor good

    public function __construct(int $id, string $name, string $lastname, string $email,
                                string $password /**$posts = null, $comments = null **/)
    {
        $this->id = $id;
        self::setName($name);
        self::setLastname($lastname);
        self::setEmail($email);
        self::setPassword($password);
        //self::setPosts($posts);
        //self::setComments($comments);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     */
    public function setComments(Comment $comment)
    {
        $this->comments = array_push($comments, $comment);
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     */
    public function setPosts(Post $post)
    {
        $this->posts = array_push($posts, $post);
    }
}
