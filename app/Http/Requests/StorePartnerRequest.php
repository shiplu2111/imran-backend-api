<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'category'   => 'required|string|max:100', // Academic, NGO, etc.
            'website'    => 'nullable|url',
            'sort_order' => 'integer',
            // Image validation (Optional on update)
            'logo'       => 'nullable|image|max:2048', // 2MB Max
        ];
    }
}
