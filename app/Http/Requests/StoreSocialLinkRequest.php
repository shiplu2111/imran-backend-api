<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'platform'   => 'required|string|max:50',
            'url'        => 'required|url',
            'icon'       => 'required|string|max:50', // Stores the icon name
            'sort_order' => 'integer',
            'is_active'  => 'boolean',
        ];
    }
}
