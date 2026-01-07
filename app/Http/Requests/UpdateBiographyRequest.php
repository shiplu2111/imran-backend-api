<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiographyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'headline'         => 'nullable|string|max:255',
            'short_bio'        => 'nullable|string',
            'full_bio'         => 'nullable|string',

            'current_location' => 'nullable|string|max:255',
            'hometown'         => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:50',
            'birthday'         => 'nullable|date',

            'image'            => 'nullable|image|max:4096', // 4MB Max
        ];
    }
}
