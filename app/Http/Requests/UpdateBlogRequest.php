<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|exists:categories,id',
            'title'       => 'sometimes|string|max:255',
            'image'       => 'nullable|image|max:4096', // Optional for update
            'description' => 'sometimes|string',
            'date'        => 'sometimes|date',
            'content'     => 'sometimes|string',
            'tags'        => 'nullable|array',
            'published'   => 'boolean'
        ];
    }
}
