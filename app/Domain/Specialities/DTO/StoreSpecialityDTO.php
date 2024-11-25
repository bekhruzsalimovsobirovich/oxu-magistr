<?php

namespace App\Domain\Specialities\DTO;

class StoreSpecialityDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $building_id;

    /**
     * @param array $data
     * @return StoreSpecialityDTO
     */
    public static function fromArray(array $data): StoreSpecialityDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setBuildingId($data['building_id']);

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
     * @return int
     */
    public function getBuildingId(): int
    {
        return $this->building_id;
    }

    /**
     * @param int $building_id
     */
    public function setBuildingId(int $building_id): void
    {
        $this->building_id = $building_id;
    }
}
