<?php

namespace App\Domain\Specialities\Models;

use App\Domain\Subjects\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class,'speciality_subjects','subject_id','speciality_id');
    }
}
