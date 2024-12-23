<?php

namespace App\Domain\Students\Repositories;

use App\Domain\Students\Models\Student;
use App\Domain\Subjects\Models\Subject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository
{
    /**
     * @param $pagination
     * @return LengthAwarePaginator
     */
    public function paginate($pagination,$filter): LengthAwarePaginator
    {
        return Student::query()
            ->Filter($filter)
            ->orderByDesc('id')
            ->paginate($pagination);
    }
}
