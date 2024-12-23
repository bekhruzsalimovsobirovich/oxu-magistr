<?php

namespace App\Domain\Subjects\Resources;

use App\Domain\Specialities\Models\Speciality;
use App\Domain\Specialities\Resources\SpecialityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'specialities' => SpecialityResource::collection($this->specialities)
        ];
    }
}
