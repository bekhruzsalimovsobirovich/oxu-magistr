<?php

namespace App\Domain\Subjects\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'speciality_id' => 'required|exists:specialities,id',
            'current_speciality_id' => 'required|exists:specialities,id',
            'name' => 'required',
            'description' => 'sometimes',
            'subject' => 'sometimes|json'
        ];
    }
}
