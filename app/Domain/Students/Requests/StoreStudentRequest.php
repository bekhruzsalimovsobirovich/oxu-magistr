<?php

namespace App\Domain\Students\Requests;

use App\Domain\Students\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'phone' => 'required|string|unique:students,phone',
            'subject_id' => [
                'required',
                'exists:subjects,id',
                $this->validateUniqueSubjectForStudent(), // Custom validation rule
            ],
        ];
    }

    /**
     * Custom validation rule to ensure the subject is unique for the student.
     *
     * @return \Closure
     */
    private function validateUniqueSubjectForStudent(): \Closure
    {
        return function ($attribute, $value, $fail) {
            // Assume `Student` and `Subject` have a BelongsToMany relationship
            $studentId = $this->route('student_id'); // Adjust as per your route or context
            if ($studentId && Student::find($studentId)?->subjects()->where('subject_id', $value)->exists()) {
                $fail('The selected subject is already assigned to the student.');
            }
        };
    }
}
