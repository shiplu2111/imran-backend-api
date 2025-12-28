<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Laravel's built-in 'current_password' rule validates the old password automatically
            'current_password' => ['required', 'current_password'],

            // 'confirmed' looks for 'password_confirmation' field automatically
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
                'different:current_password',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'The current password field is required.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The passwords do not match.',
        ];
    }
}
