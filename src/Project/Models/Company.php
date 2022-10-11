<?php

declare(strict_types=1);

namespace Project\Models;

class Company implements Entity
{
    private int $id;
    private int $organizationNumber;
    private string $name;
    private string $notes;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getOrganizationNumber(): int
    {
        return $this->organizationNumber;
    }

    /**
     * @param int $organizationNumber
     */
    public function setOrganizationNumber(int $organizationNumber): void
    {
        $this->organizationNumber = $organizationNumber;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}