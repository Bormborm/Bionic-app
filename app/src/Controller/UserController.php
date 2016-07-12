<?php

namespace Bormborm\Controller;

use Bormborm\Model\Repository\User;

class UserController
{
    public function getUser()
    {
        $user = new User();
        $user->getUserById(1);

    }


}