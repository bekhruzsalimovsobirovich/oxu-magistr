<?php

namespace App\Domain\Subjects\DTO;

use App\Domain\Subjects\Models\Subject;

class UpdateSubjectDTO
{
    /**
     * @var int
     */
    private int $current_speciality_id;

    /**
     * @var int
     */
    private int $speciality_id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @var Subject
     */
    private Subject $subject;

    /**
     * @param array $data
     * @return UpdateSubjectDTO
     */
    public static function fromArray(array $data): UpdateSubjectDTO
    {
        $dto = new self();
        $dto->setSpecialityId($data['speciality_id']);
        $dto->setCurrentSpecialityId($data['current_speciality_id']);
        $dto->setName($data['name']);
        $dto->setDescription($data['description'] ?? null);
        $dto->setSubject($data['subject']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getCurrentSpecialityId(): int
    {
        return $this->current_speciality_id;
    }

    /**
     * @param int $current_speciality_id
     */
    public function setCurrentSpecialityId(int $current_speciality_id): void
    {
        $this->current_speciality_id = $current_speciality_id;
    }

    /**
     * @return int
     */
    public function getSpecialityId(): int
    {
        return $this->speciality_id;
    }

    /**
     * @param int $speciality_id
     */
    public function setSpecialityId(int $speciality_id): void
    {
        $this->speciality_id = $speciality_id;
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

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     */
    public function setSubject(Subject $subject): void
    {
        $this->subject = $subject;
    }
}
