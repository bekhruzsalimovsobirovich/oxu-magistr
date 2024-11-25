<?php

namespace App\Domain\Specialities\Repositories;

use App\Domain\Specialities\Models\Speciality;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SpecialityRepository
{
    /**
     * @param $pagination
     * @return LengthAwarePaginator
     */
    public function paginate($pagination): LengthAwarePaginator
    {
        return Speciality::query()
            ->orderByDesc('id')
            ->paginate($pagination);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll($filter): Collection|array
    {
        return Speciality::query()
            ->Filter($filter)
            ->get()
            ->sortBy('name');
    }
}
