<?php

namespace App\Domain\Students\DTO;

class StoreStudentDTO
{
    /**
     * @var int
     */
    private int $subject_id;

    /**
     * @var string
     */
    private string $fio;

    /**
     * @var string
     */
    private string $group;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @param array $data
     * @return StoreStudentDTO
     */
    public static function fromArray(array $data): StoreStudentDTO
    {
        $dto = new self();
        $dto->setSubjectId($data['subject_id']);
        $dto->setFio($data['fio']);
        $dto->setGroup($data['group']);
        $dto->setPhone($data['phone']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getSubjectId(): int
    {
        return $this->subject_id;
    }

    /**
     * @param int $subject_id
     */
    public function setSubjectId(int $subject_id): void
    {
        $this->subject_id = $subject_id;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @param string $fio
     */
    public function setFio(string $fio): void
    {
        $this->fio = $fio;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
