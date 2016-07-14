<?php
/**
 * Created by PhpStorm.
 * User: Borm
 * Date: 12.07.2016
 * Time: 14:01
 */

namespace Bormborm\Model;


class Post
{
    /**
     * @var int
     */
    private $postId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var int
     */
    private $imageId;

    public function __construct(int $id, string $text)
    {
        $this->postId = $id;
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId)
    {
        $this->postId = $postId;
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
    public function getImageId(): int
    {
        return $this->imageId;
    }

    /**
     * @param int $imageId
     */
    public function setImageId(int $imageId)
    {
        $this->imageId = $imageId;
    }


}