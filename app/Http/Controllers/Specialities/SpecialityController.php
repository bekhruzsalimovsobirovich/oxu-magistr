<?php

namespace App\Http\Controllers\Specialities;

use App\Domain\Specialities\Actions\StoreSpecialityAction;
use App\Domain\Specialities\DTO\StoreSpecialityDTO;
use App\Domain\Specialities\Models\Speciality;
use App\Domain\Specialities\Repositories\SpecialityRepository;
use App\Domain\Specialities\Requests\SpecialityFilterRequest;
use App\Domain\Specialities\Requests\StoreSpecialityRequest;
use App\Domain\Specialities\Resources\SpecialityResource;
use App\Filters\SpecialityFilter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SpecialityController extends Controller
{
    /**
     * @var mixed|SpecialityRepository
     */
    public mixed $specialities;

    /**
     * @param SpecialityRepository $specialityRepository
     */
    public function __construct(SpecialityRepository $specialityRepository)
    {
        $this->specialities = $specialityRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function paginate()
    {
        return SpecialityResource::collection($this->specialities->paginate(request()->query('pagination', 20)));
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function getAll(SpecialityFilterRequest $request)
    {
        $filter = app()->make(SpecialityFilter::class, ['queryParams' => array_filter($request->validated())]);

        return $this->successResponse('', SpecialityResource::collection($this->specialities->getAll($filter)));
    }

    /**
     * @param StoreSpecialityRequest $request
     * @param StoreSpecialityAction $action
     * @return JsonResponse
     */
    public function store(StoreSpecialityRequest $request, StoreSpecialityAction $action)
    {
        try {
            $dto = StoreSpecialityDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('Speciality created successfully', new SpecialityResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
