<?php

namespace Bormborm\Model;

use Bormborm\Model\Comment;
use Bormborm\Model\Post;

class User
{
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
    /**
     * @var string
     */
    private $userAvatar;

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
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
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
     * @return $this
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
        return $this;
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
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
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
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
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
     * @return $this
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
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
     * @return $this
     */
    public function setComments(Comment $comment)
    {
        $this->comments = array_push($comments, $comment);
        return $this;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param Post []
     * @return $this
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAvatar(): string
    {
        return $this->userAvatar;
    }

    /**
     * @param string $userAvatar
     * @return $this
     */
    public function setUserAvatar(string $userAvatar)
    {
        $this->userAvatar = $userAvatar;
        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $response = $this->getName() . " " . $this->getLastname();
        return $response;
    }
}
