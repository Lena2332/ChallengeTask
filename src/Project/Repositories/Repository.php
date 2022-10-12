<?php

declare(strict_types=1);

namespace Project\Repositories;

use DI\FactoryInterface;
use Project\DB;
use Project\Models\Entity;

abstract class Repository
{
    protected DB $db;
    protected \PDO $connection;
    protected string $table;
    protected Entity $entity;

    public function __construct(
        DB $db
    )
    {
        $this->db = $db;
        $this->connection = $this->db->getConnection();
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->query('DELETE FROM ' . $this->table. ' WHERE id = '. $id);
        return $query->execute();
    }
}