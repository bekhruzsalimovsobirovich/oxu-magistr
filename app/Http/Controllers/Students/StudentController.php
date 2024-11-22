<?php

namespace App\Http\Controllers\Students;

use App\Domain\Students\Actions\StoreStudentAction;
use App\Domain\Students\DTO\StoreStudentDTO;
use App\Domain\Students\Repositories\StudentRepository;
use App\Domain\Students\Requests\StoreStudentRequest;
use App\Domain\Students\Resources\StudentResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    /**
     * @var mixed|StudentRepository
     */
    public mixed $students;

    /**
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->students = $studentRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function paginate()
    {
        return StudentResource::collection($this->students->paginate(\request()->query('pagination',20)));
    }

    /**
     * @param StoreStudentRequest $request
     * @param StoreStudentAction $action
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request, StoreStudentAction $action)
    {
        try {
            $dto = StoreStudentDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('Student registered successfully.', new StudentResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
