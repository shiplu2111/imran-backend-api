<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'The name field is required.',
            'email.required'  => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'email.unique'    => 'The email has already been taken.',
            'password.confirmed' => 'The passwords do not match.',

        ];
    }
}
