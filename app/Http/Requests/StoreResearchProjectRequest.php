<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResearchProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'status'       => 'required|string|max:50', // Ongoing, Completed
            'start_date'   => 'required|string|max:20',
            'end_date'     => 'nullable|string|max:20',
            'is_current'   => 'boolean',
            'description'  => 'required|string',
            'is_published' => 'boolean',
            'sort_order'   => 'integer',
        ];
    }
}
