<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Set to true
    }

    public function rules(): array
    {
        return [
            'category_id'   => 'required|exists:categories,id',
            'headline'      => 'required|string|max:255',
            'source'        => 'required|string|max:255',
            'date'          => 'required|date',
            'excerpt'       => 'required|string',
            'external_link' => 'nullable|url', // Must be a valid URL
            'published'     => 'boolean'
        ];
    }
}
