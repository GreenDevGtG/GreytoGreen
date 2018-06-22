<?php

namespace Aston\Db;

class Connection
{
    private static $pdo;

    public static function getPDO(string $dsn = '', string $user = '', string $pass = ''): \PDO
    {
        if(self::$pdo === null){
            self::$pdo = new \PDO($dsn,$user,$pass);
            self::$pdo->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }
        return self::$pdo;
    }
}