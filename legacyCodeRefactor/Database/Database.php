<?php

namespace App\Database;

use App\Exception\InternalServerErrorException;
use PDO;
use PDOStatement;

class Database
{
    private static PDO $connection;

    /**
     * @throws InternalServerErrorException
     */
    public static function init(): void
    {
        try {
            self::$connection = new PDO(
                sprintf('mysql:host=%s;dbname=%s', $_ENV['DATABASE_HOSTNAME'], $_ENV['DATABASE_NAME']),
                $_ENV['DATABASE_USERNAME'],
                $_ENV['DATABASE_PASSWORD']
            );
        } catch (\PDOException $exception) {
            throw new InternalServerErrorException($exception);
        }
    }

    protected function prepare(string $query, array $options = []): PDOStatement|false
    {
        return self::$connection->prepare($query, $options);
    }
}
