<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoundationDonationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // <--- Change to true
    }
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'provider_id' => 'required|string|max:50',
            'status'      => 'required|in:active,coming_soon,inactive',
            'sort_order'  => 'nullable|integer',
        ];
    }
}
