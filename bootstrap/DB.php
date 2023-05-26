<?php
declare(strict_types=1);

namespace bootstrap;

use PDO;

class DB
{
    private static $connection;

    public static function getConnection(): PDO
    {
        if (!self::$connection) {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s',
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('DB_DATABASE'),
            );
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            try {
                self::$connection = new PDO($dsn, $username, $password);
            } catch (\PDOException $exception) {
                throw new \Exception("DB connection failed: {$exception->getMessage()}");
            }
        }
        return self::$connection;
    }
}
