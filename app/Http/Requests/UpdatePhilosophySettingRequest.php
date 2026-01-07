<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhilosophySettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quote'              => 'required|string',
            'quote_author'       => 'nullable|string',
            'vision_title'       => 'nullable|string',
            'vision_description' => 'required|string',

            // Core Values (Array validation)
            'core_values'        => 'nullable|array',
            'core_values.*.title'=> 'required|string',
            'core_values.*.description' => 'required|string',
            'core_values.*.icon' => 'required|string', // e.g. "Microscope", "Globe"
        ];
    }
}
