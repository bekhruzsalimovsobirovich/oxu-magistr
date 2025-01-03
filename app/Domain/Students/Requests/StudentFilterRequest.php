<?php

namespace App\Domain\Students\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'sometimes',
            'group' => 'sometimes',
            'speciality_id' => 'sometimes|exists:specialities,id',
            'subject_id' => 'sometimes|exists:subjects,id'
        ];
    }
}
