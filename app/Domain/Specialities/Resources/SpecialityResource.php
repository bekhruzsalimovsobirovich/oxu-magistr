<?php

namespace App\Domain\Specialities\Resources;

use App\Domain\Buildings\Resources\BuildingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecialityResource extends JsonResource
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
            'buildings' => BuildingResource::collection($this->buildings)
        ];
    }
}
