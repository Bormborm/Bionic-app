<?php
/**
 * Created by PhpStorm.
 * User: Borm
 * Date: 12.07.2016
 * Time: 14:02
 */

namespace Bormborm\Model\Repository;


class Comment extends AbstractRepository
{
    public function getAllByUserId(int $id)
    {
        $conn = self::getConnection();

    }

}