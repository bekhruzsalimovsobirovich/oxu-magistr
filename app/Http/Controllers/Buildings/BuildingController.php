<?php

namespace App\Http\Controllers\Buildings;

use App\Domain\Buildings\Models\Building;
use App\Domain\Buildings\Resources\BuildingResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function getAll()
    {
        return $this->successResponse('', BuildingResource::collection(Building::query()->get()));
    }
}
