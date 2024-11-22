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
            ->orderByDesc('id')
            ->paginate($pagination);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Subject::query()
            ->get()
            ->sortBy('name');
    }
}
