<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|max:4096',
            'description' => 'required|string',
            'date'        => 'required|date',
            // 'author'   => 'required|string', // REMOVED: We will set this automatically
            'content'     => 'required|string',
            'tags'        => 'nullable|array',
            'published'   => 'boolean'
        ];
    }
}
