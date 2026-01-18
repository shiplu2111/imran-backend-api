<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'message'     => 'required|string',
            'image'       => 'nullable|image|max:2048', // 2MB Max
            'sort_order'  => 'integer',
            'is_active'   => 'boolean',
        ];
    }
}
