<?php

namespace App\Domain\Subjects\Models;

use App\Domain\Specialities\Models\Speciality;
use App\Domain\Students\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_subjects', 'subject_id', 'student_id');
    }

    /**
     * @return BelongsToMany
     */
    public function specialities(): BelongsToMany
    {
        return $this->belongsToMany(Speciality::class, 'speciality_subjects', 'subject_id', 'speciality_id');
    }
}
