<?php

namespace Project\Controllers;

interface ControllerInterface
{
    public function add(): void;

    public function edit(int $id): void;

    public function getAll();

    public function store(array $data): void;

    public function update(int $id, array $data): void;

    public function delete(int $id): void;
}