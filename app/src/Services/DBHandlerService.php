<?php

namespace Bormborm\Services;

use Doctrine\DBAL\DriverManager;

class DBHandlerService
{
    public static function getConnection()
    {
        $connectionParams = array(
            'dbname' => 'pantheon',
            'user' => 'olympus',
            'password' => 'odin3306',
            'host' => '192.168.1.4',
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

