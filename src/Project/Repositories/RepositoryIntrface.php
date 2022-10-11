<?php

declare(strict_types=1);

namespace Project\Repositories;

use Project\Models\Entity;

interface RepositoryIntrface
{
    public function getAll(): array;

    public function getById(int $id): ?Entity;

    public function applyMapper(array $data): Entity;

    public function store(array $data): ?int;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}