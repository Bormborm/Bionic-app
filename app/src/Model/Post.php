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
    private $postId;
    private $text;
    private $image;

    public function __construct(int $id, string $text)
    {
        $this->postId = $id;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $id
     */
    public function setPostId($id)
    {
        $this->postId = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}