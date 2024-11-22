<?php

namespace App\Domain\Subjects\DTO;

use App\Domain\Subjects\Models\Subject;

class UpdateSubjectDTO
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
        $dto->setName($data['name']);
        $dto->setDescription($data['description'] ?? null);
        $dto->setSubject($data['subject']);

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
