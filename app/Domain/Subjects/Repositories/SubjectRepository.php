<?php

namespace App\Domain\Subjects\Repositories;

use App\Domain\Subjects\Models\Subject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SubjectRepository
{
    /**
     * @param $pagination
     * @return LengthAwarePaginator
     */
    public function paginate($pagination): LengthAwarePaginator
    {
        return Subject::query()
            ->with('specialities')
            ->orderByDesc('id')
            ->paginate($pagination);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll($speciality_id): Collection|array
    {
        $subjects = Subject::query()
            ->whereHas('specialities', function ($query) use ($speciality_id) {
                $query->where('speciality_id', $speciality_id);
            })
            ->get();

        return $subjects->filter(function ($subject) {
            return $subject->students()->count() === 0;
        });
    }
}
