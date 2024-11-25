<?php

namespace App\Domain\Subjects\Actions;

use App\Domain\Subjects\DTO\StoreSubjectDTO;
use App\Domain\Subjects\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreSubjectAction
{
    /**
     * @param StoreSubjectDTO $dto
     * @return Subject
     * @throws Exception
     */
    public function execute(StoreSubjectDTO $dto): Subject
    {
        DB::commit();
        try {
            $subject = new Subject();
            $subject->name = $dto->getName();
            $subject->description = $dto->getDescription();
            $subject->save();

            $subject->specialities()->attach($dto->getSpecialityId());
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $subject;
    }
}
