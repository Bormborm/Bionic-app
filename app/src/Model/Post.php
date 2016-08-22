<?php

namespace Bormborm\Model;

class Post
{

    public function __construct(int $id, string $text, string $date, string $userName)
    {
        $this->postId = $id;
        $this->text = $text;
        $this->date = $date;
        $this->userName = $userName;
    }

    /**
     * @var string
     */
    private $userName;
    /**
     * @var int
     */
    private $postId;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $date;
    /**
     * @var Comment []
     */
    private $comments;

    /**
     * @return string
     */
    public function getDate() : string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
//    public function getImageId(): int
//    {
//        return $this->imageId;
//    }

    /**
     * @param int $imageId
     */
//    public function setImageId(int $imageId)
//    {
//        $this->imageId = $imageId;
//    }

    /**
     * @param mixed $comments
     * @return Post
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     * @return $this
     */
    public function setId(int $postId)
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId(int $userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return $this
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
        return $this;
    }
}
