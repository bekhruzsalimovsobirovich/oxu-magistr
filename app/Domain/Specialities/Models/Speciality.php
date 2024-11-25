<?php

namespace App\Domain\Specialities\Models;

use App\Domain\Buildings\Models\Building;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    use Filterable;

    /**
     * @return BelongsToMany
     */
    public function buildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class,'speciality_buildings','speciality_id','building_id');
    }
}
