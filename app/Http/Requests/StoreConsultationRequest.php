<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email|max:255',
            'type'      => 'required|string|in:Ruminants,Poultry', // Strict check
            'message'   => 'required|string',
            'date'      => 'nullable|date', // User might not know exact date yet
        ];
    }
}
