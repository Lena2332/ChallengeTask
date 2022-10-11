<?php

declare(strict_types=1);

namespace Project\Repositories;

use Project\DB;
use Project\Models\Company;
use Project\Models\Entity;

class CompanyRepository extends Repository implements RepositoryIntrface
{
    public function __construct(
        DB $db
    )
    {
        parent::__construct($db);

        $this->table = 'companies';
    }

    /**
     * @param array $data
     * @return Entity
     * Add data from DB to our Entity
     */
    public function applyMapper(array $data): Entity
    {
        $this->entity = new Company();
        $this->entity->setId($data['id']);
        $this->entity->setName($data['name']);
        $this->entity->setNotes($data['notes']);
        $this->entity->setOrganizationNumber($data['organization_number']);

        return $this->entity;
    }

    /**
     * @param array $data
     * @return int
     */
    public function store(array $data): ?int
    {
        $sql = "INSERT INTO ". $this->table ." (name, organization_number, notes) VALUES (:name, :organization_number, :notes)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);

        return (int) $this->connection->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = "UPDATE ". $this->table ." SET name=:name, organization_number=:organization_number, notes=:notes WHERE id=:id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($data);
    }
}