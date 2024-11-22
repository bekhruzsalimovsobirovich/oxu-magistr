<?php

namespace App\Domain\Subjects\DTO;

class StoreSubjectDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @param array $data
     * @return StoreSubjectDTO
     */
    public static function fromArray(array $data): StoreSubjectDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setDescription($data['description'] ?? null);

        return $dto;
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
