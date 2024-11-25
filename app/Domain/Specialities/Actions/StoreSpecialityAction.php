<?php

namespace App\Domain\Specialities\Actions;

use App\Domain\Specialities\DTO\StoreSpecialityDTO;
use App\Domain\Specialities\Models\Speciality;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreSpecialityAction
{
    /**
     * @param StoreSpecialityDTO $dto
     * @return Speciality
     * @throws Exception
     */
    public function execute(StoreSpecialityDTO $dto): Speciality
    {
        DB::beginTransaction();
        try {
            $speciality = new Speciality();
            $speciality->name = $dto->getName();
            $speciality->save();
            $speciality->buildings()->attach($dto->getBuildingId());
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

        return $speciality;
    }
}
