<?php

namespace Bormborm\Services;

use Doctrine\DBAL\DriverManager;

abstract class DBHandlerService
{
    public static function getConnection()
    {
        $connectionParams = array(
            'dbname' => 'pantheon',
            'user' => 'olympus',
            'password' => 'odin3306',
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql',
        );
        return DriverManager::getConnection($connectionParams);
    }

    public static function query($sql_query)
    {
        $connection = static::getConnection();
        return $connection->query($sql_query);
    }

}