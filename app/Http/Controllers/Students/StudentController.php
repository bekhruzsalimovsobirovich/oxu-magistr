<?php

namespace App\Http\Controllers\Students;

use App\Domain\Students\Actions\StoreStudentAction;
use App\Domain\Students\DTO\StoreStudentDTO;
use App\Domain\Students\Models\Student;
use App\Domain\Students\Repositories\StudentRepository;
use App\Domain\Students\Requests\StoreStudentRequest;
use App\Domain\Students\Requests\StudentFilterRequest;
use App\Domain\Students\Resources\StudentResource;
use App\Exports\StudentExport;
use App\Filters\StudentFilter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Maatwebsite\Excel\Facades\Excel;

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
     * @throws BindingResolutionException
     */
    public function paginate(StudentFilterRequest $request)
    {
        $filter = app()->make(StudentFilter::class,['queryParams' => array_filter($request->validated())]);
        return StudentResource::collection($this->students->paginate(\request()->query('pagination',20),$filter));
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

    public function destroy(Student $student)
    {
        $student->delete();

        return $this->successResponse('Student deleted');
    }

    public function export()
    {
        return Excel::download(new StudentExport(\request()->query('speciality_id')), 'students.xlsx');
    }
}
