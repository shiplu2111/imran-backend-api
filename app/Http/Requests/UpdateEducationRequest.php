<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'degree'             => 'required|string|max:255',
            'field_of_study'     => 'nullable|string',
            'institution'        => 'required|string|max:255',
            'location'           => 'nullable|string|max:255',
            'start_date'         => 'required|string|max:20',
            'end_date'           => 'nullable|string|max:20',
            'currently_pursuing' => 'boolean',
        ];
    }
}
