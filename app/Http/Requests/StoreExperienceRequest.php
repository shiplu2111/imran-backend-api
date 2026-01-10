<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role'         => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'start_date'   => 'required|string|max:20',
            'end_date'     => 'nullable|string|max:20',
            'is_current'   => 'boolean',
            'description'  => 'required|string',
            'is_published' => 'boolean',
            'sort_order'   => 'integer',
        ];
    }
}
