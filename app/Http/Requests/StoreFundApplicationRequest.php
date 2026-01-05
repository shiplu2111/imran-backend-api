<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFundApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'organization'     => 'nullable|string|max:255',
            'support_type'     => 'required|string', // You can add |in:Research Grant,Academic Scholarship... if you want strict lists
            'research_area' => 'required|string|max:255',
            'amount_requested' => 'nullable|numeric|min:0',
            'purpose'          => 'required|string|max:255',
            'proposal_summary' => 'required|string',
            'country'       => 'nullable|string|max:100',
            'project_title' => 'nullable|string|max:255',

            // Document Validation: Max 10MB, PDF or Word
            'document'         => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            // 'confirm' field is frontend only validation, backend just needs data
        ];
    }
}
