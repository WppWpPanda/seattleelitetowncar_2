<?php

use DigitalStars\DataBase\DB;

/*
CREATE TABLE `users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
*/

class Database
{
    private static $connections = [];

    public static function connect($configName = 'default')
    {
        global $wpp_db;
        if (!isset(self::$connections[$configName])) {
            $dbConfig = $wpp_db['db']['default'];

            /*self::$connections[$configName] = DB::create([
                'host' => $dbConfig['host'],
                'port' => $dbConfig['port'],
                'dbname' => $dbConfig['dbname'],
                'username' => $dbConfig['username'],
                'password' => $dbConfig['password'],
                'charset' => $dbConfig['charset'],
                'options' => $dbConfig['options'] ?? []
            ]);*/

            self::$connections[$configName] = new DB('mysql:host='. $dbConfig['host'].';dbname='. $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
        }

        return self::$connections[$configName];
    }
}