<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class StudentFilter extends AbstractFilter
{
    public const FIO = 'fio';
    public const GROUP = 'group';
    public const SUBJECT_ID = 'subject_id';
    public const SPECIALITY_ID = 'speciality_id';

    /**
     * @return array[]
     */
    #[ArrayShape([self::FIO => "array", self::GROUP => "array", self::SUBJECT_ID => "array", self::SPECIALITY_ID => "array"])] protected function getCallbacks(): array
    {
        return [
            self::FIO => [$this, 'fio'],
            self::GROUP => [$this, 'group'],
            self::SUBJECT_ID => [$this, 'subject_id'],
            self::SPECIALITY_ID => [$this, 'speciality_id'],
        ];
    }

    public function fio(Builder $builder, $value): void
    {
        $builder->where('fio', 'like', '%' . $value . '%');
    }

    public function group(Builder $builder, $value): void
    {
        $builder->where('group', 'like', '%' . $value . '%');
    }

    public function subject_id(Builder $builder, $value): void
    {
        $builder->whereHas('subjects', function ($query) use ($value) {
            $query->where('subject_id',$value);
        });
    }

    public function speciality_id(Builder $builder, $value): void
    {
        $builder->whereHas('subjects', function ($query) use ($value) {
            $query->whereHas('specialities',function ($subQuery) use ($value){
                $subQuery->where('speciality_id',$value);
            });
        });
    }
}
