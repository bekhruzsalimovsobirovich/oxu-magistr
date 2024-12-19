<?php

namespace App\Domain\Students\Requests;

use App\Domain\Students\Models\Student;
use App\Domain\Subjects\Models\Subject;
use App\Models\StudentSubject;
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
                // Custom validation to ensure unique subject for the student
                function ($attribute, $value, $fail) {
                    if (StudentSubject::query()->where('subject_id', $value)->exists()) {
                        $fail("The selected {$attribute} is already assigned to another student.");
                    }
                },
            ],
        ];
    }
}
