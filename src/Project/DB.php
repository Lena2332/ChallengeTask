<?php

declare(strict_types=1);

namespace Project;

class DB
{
    private static \PDO $connection;
    private array $connectionParams;
    public const DB_NAME = 'database';
    public const DB_USER = 'user';
    public const DB_PASSWORD = 'password';
    public const DB_HOST = 'host';
    public const DB_PORT = 'port';

    /**
     * @param array $connectionParams
     */
    public function __construct(
        array $connectionParams
    ) {
        $this->connectionParams = $connectionParams;
    }

    public function getConnection(): \PDO
    {

        if (!isset(self::$connection)) {
            self::$connection = new \PDO(
                "mysql:host=".$this->connectionParams[self::DB_HOST].";dbname=" . $this->connectionParams[self::DB_NAME],
                $this->connectionParams[self::DB_USER],
                $this->connectionParams[self::DB_PASSWORD]
            );

            self::$connection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        }

        return self::$connection;
    }
}
