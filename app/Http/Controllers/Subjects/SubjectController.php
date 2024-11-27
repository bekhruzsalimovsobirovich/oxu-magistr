<?php

namespace App\Http\Controllers\Subjects;

use App\Domain\Specialities\Models\Speciality;
use App\Domain\Subjects\Actions\StoreSubjectAction;
use App\Domain\Subjects\Actions\UpdateSubjectAction;
use App\Domain\Subjects\DTO\StoreSubjectDTO;
use App\Domain\Subjects\DTO\UpdateSubjectDTO;
use App\Domain\Subjects\Models\Subject;
use App\Domain\Subjects\Repositories\SubjectRepository;
use App\Domain\Subjects\Requests\StoreSubjectRequest;
use App\Domain\Subjects\Requests\UpdateSubjectRequest;
use App\Domain\Subjects\Resources\SubjectResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    /**
     * @var mixed|SubjectRepository
     */
    public mixed $subjects;

    /**
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjects = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubjectResource::collection($this->subjects->paginate(\request()->query('pagination', 20)));
    }

    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return $this->successResponse('', $this->subjects->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request, StoreSubjectAction $action)
    {
        try {
            $dto = StoreSubjectDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('Subject created.', new SubjectResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject, UpdateSubjectAction $action)
    {
        try {
            $dto = UpdateSubjectDTO::fromArray(array_merge($request->validated(), ['subject' => $subject]));
            $response = $action->execute($dto);

            return $this->successResponse('Subject updated.', new SubjectResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return $this->successResponse('Subject deleted successfully.');
    }
}
