<?php

namespace App\Domain\Students\Actions;

use App\Domain\Students\DTO\StoreStudentDTO;
use App\Domain\Students\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreStudentAction
{
    /**
     * @param StoreStudentDTO $dto
     * @return Student
     * @throws Exception
     */
    public function execute(StoreStudentDTO $dto): Student
    {
        DB::beginTransaction();
        try {
            $student = new Student();
            $student->fio = $dto->getFio();
            $student->group = $dto->getGroup();
            $student->phone = $dto->getPhone();
            $student->save();

            $student->subjects()->attach($dto->getSubjectId(),[
                'date' => now()->format('Y-m-d')
            ]);
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

        return $student;
    }
}
