<?php

namespace App\Domain\Subjects\Actions;

use App\Domain\Subjects\DTO\StoreSubjectDTO;
use App\Domain\Subjects\DTO\UpdateSubjectDTO;
use App\Domain\Subjects\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateSubjectAction
{
    /**
     * @param UpdateSubjectDTO $dto
     * @return Subject
     * @throws Exception
     */
    public function execute(UpdateSubjectDTO $dto): Subject
    {
        DB::commit();
        try {
            $subject = $dto->getSubject();
            $subject->name = $dto->getName();
            $subject->description = $dto->getDescription();
            $subject->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $subject;
    }
}
