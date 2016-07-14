<?php
try {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
} catch (Exception $e)
{
    //print $e->getMessage();
}
require_once 'src/Model/Repository/User.php';


$user = new \Bormborm\Model\Repository\User();
$userResult = $user->getUserById($_GET['id']);
var_dump($userResult);
print $userResult['name']; //WTF?


