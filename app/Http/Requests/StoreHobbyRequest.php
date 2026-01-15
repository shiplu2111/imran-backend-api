<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHobbyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'integer',

            // Image Validation (Optional on Update, Required on Create logic is handled in controller/frontend usually, or use 'sometimes')
            'image'       => 'nullable|image|max:2048', // 2MB Max
        ];
    }
}
