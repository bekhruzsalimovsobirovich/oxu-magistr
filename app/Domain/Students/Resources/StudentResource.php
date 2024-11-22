<?php

namespace App\Domain\Students\Resources;

use App\Domain\Subjects\Resources\SubjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'fio' => $this->fio,
            'group' => $this->group,
            'phone' => $this->phone,
            'subject' => $this->subjects
        ];
    }
}
