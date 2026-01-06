<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
        'title'          => 'required|string|max:255',
        'author'         => 'required|string|max:255',
        'description'    => 'required|string',
        'published_year' => 'required|integer|min:100|max:' . (date('Y') + 1),

        // Ensure type is one of the 3 specific options
        'type'           => 'required|string|in:Inspirational,Historic,Religious',

        'thumbnail'      => 'required|image|max:5120', // 5MB Image
        'pdf'            => 'required|mimes:pdf|max:20480', // 20MB PDF
        'is_published'   => 'boolean'
    ];
}
}
