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

    /**
     * @return array Models/Company[]
     */
    public function getAll(): array
    {
        $query = $this->connection->query('SELECT * FROM ' . $this->table);

        $outputArray = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $outputArray[] =  $this->applyMapper($data);
        }

        return $outputArray;
    }

    /**
     * @param int $id
     * @return Entity|null
     */
    public function getById(int $id): ?Entity
    {
        $query = $this->connection->query('SELECT * FROM ' . $this->table. ' WHERE id = '. $id);
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->applyMapper($data);
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->query('DELETE FROM ' . $this->table. ' WHERE id = '. $id);
        return $query->execute();
    }
}