<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'   => 'sometimes|exists:categories,id',
            'headline'      => 'sometimes|string|max:255',
            'source'        => 'sometimes|string|max:255',
            'date'          => 'sometimes|date',
            'excerpt'       => 'sometimes|string',
            'external_link' => 'nullable|url',
            'published'     => 'boolean'
        ];
    }
}
