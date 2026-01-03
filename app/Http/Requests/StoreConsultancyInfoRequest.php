<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultancyInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 1. REMOVE the complex 'unique' logic causing the error.
            // 2. JUST CHECK if it is a string.
            'type' => 'required|string|max:50',

            'page_heading' => 'required|string|max:255',
            'sub_heading' => 'required|string',
            'payment_information' => 'required|string',
            'sections' => 'required|array',
            'sections.*.title' => 'required|string',
            'sections.*.description' => 'required|string',
        ];
    }
}
