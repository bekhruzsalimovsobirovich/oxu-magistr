<?php

namespace App\Domain\Specialities\DTO;

class StoreSpecialityDTO
{
    /**
     * @var string
     */
    private string $name;


    /**
     * @param array $data
     * @return StoreSpecialityDTO
     */
    public static function fromArray(array $data): StoreSpecialityDTO
    {
        $dto = new self();
        $dto->setName($data['name']);

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
}
