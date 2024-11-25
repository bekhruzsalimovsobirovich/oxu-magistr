<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class SpecialityFilter extends AbstractFilter
{
    public const BUILDING_ID = 'building_id';

    /**
     * @return array[]
     */
    #[ArrayShape([self::BUILDING_ID => "array"])] protected function getCallbacks(): array
    {
        return [
            self::BUILDING_ID => [$this, 'building_id']
        ];
    }

    public function building_id(Builder $builder, $value): void
    {
        $builder->whereHas('buildings', function ($query) use ($value) {
            $query->where('building_id',$value);
        });
    }
}
