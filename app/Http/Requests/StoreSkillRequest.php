<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'category'   => 'required|string|in:laboratory,software,tools',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}
