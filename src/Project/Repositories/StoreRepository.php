<?php

declare(strict_types=1);

namespace Project\Repositories;

use Project\DB;
use Project\Models\Store;
use Project\Models\Entity;

class StoreRepository extends Repository implements RepositoryIntrface
{
    private CompanyRepository $companyRepository;

    public function __construct(
        DB $db,
        \DI\FactoryInterface $factory
    )
    {
        parent::__construct($db);

        $this->table = 'stores';
        $this->companyRepository = $factory->make(CompanyRepository::class);
    }

    /**
     * @param array $data
     * @return Entity
     * Add data from DB to our Entity
     */
    public function applyMapper(array $data): Entity
    {
        $this->entity = new Store();
        $this->entity->setId($data['id']);
        $this->entity->setName($data['name']);
        $this->entity->setCompanyId($data['company_id']);
        $this->entity->setAddress($data['address']);
        $this->entity->setCity($data['city']);
        $this->entity->setZip($data['zip']);
        $this->entity->setCountry($data['country']);
        $this->entity->setLongitude($data['longitude']);
        $this->entity->setCompanyName($data['company_name']);

        return $this->entity;
    }

    /**
     * @return array Models/Company[]
     */
    public function getAll(): array
    {
        $query = $this->connection->query('SELECT ' . $this->table . '.*, companies.name as company_name
                                                    FROM ' . $this->table . '
                                                    INNER JOIN companies 
                                                    ON ' . $this->table . '.company_id = companies.id');

        $outputArray = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $outputArray[] =  $this->applyMapper($data);
        }

        return $outputArray;
    }

    /**
     * @return array Models/Company[]
     */
    public function getAllByCompanyId(int $companyId): array
    {
        $queryString = '';

        if ($companyId) {
            $queryString = ' WHERE company_id = ' . $companyId;
        }

        $query = $this->connection->query('SELECT ' . $this->table . '.*, companies.name as company_name 
                                                    FROM ' . $this->table . '
                                                    INNER JOIN companies 
                                                    ON ' . $this->table . '.company_id = companies.id'. $queryString);

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
        $query = $this->connection->query('SELECT ' . $this->table . '.*, companies.name as company_name
                                                    FROM ' . $this->table. '
                                                    INNER JOIN companies 
                                                    ON ' . $this->table . '.company_id = companies.id
                                                    WHERE ' . $this->table. '.id = ' . $id);
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->applyMapper($data);
    }

    /**
     * @param array $data
     * @return int
     */
    public function store(array $data): ?int
    {
        $sql = "INSERT
                  INTO ". $this->table ."
                   (name,
                    company_id,
                    address,
                    city,
                    zip,
                    country,
                    longitude)
                VALUES
                  (:name,
                   :company_id,
                   :address,
                   :city,
                   :zip,
                   :country,
                   :longitude)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);

        return (int) $this->connection->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        $sql = "UPDATE 
                 ". $this->table ." 
                 SET 
                    name=:name,
                    company_id=:company_id,
                    address=:address,
                    city=:city,
                    zip=:zip,
                    country=:country,
                    longitude=:longitude   
                 WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * @return array Models/Company[]
     */
    public function getCompanies(): array
    {
        return $this->companyRepository->getAll();
    }
}