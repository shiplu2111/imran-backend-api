<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoundationSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Basic
            'name'                => 'required|string|max:255',
            'tagline'             => 'nullable|string|max:255',
            'year_established'    => 'nullable|string|max:4',
            'registration_number' => 'nullable|string|max:100',

            // Mission/Vision
            'mission'             => 'nullable|string',
            'vision'              => 'nullable|string',

            // Contact
            'email'               => 'nullable|email',
            'phone'               => 'nullable|string',
            'address'             => 'nullable|string',

            // CTA
            'cta_text'            => 'nullable|string',

            // Logo
            'logo'                => 'nullable|image|max:2048',

            // Services (JSON Array)
            'services'            => 'nullable|array',
            'services.*.title'    => 'required|string',
            'services.*.description' => 'required|string',
        ];
    }
}
