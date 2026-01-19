<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // <--- IMPORTANT: Set to true
    }

    public function rules()
    {
        return [
            'site_name'     => 'required|string|max:255',
            'logo_type'     => 'required|in:text,image',

            // If type is 'text', logo_text is required
            'logo_text'     => 'nullable|required_if:logo_type,text|string|max:50',

            // If type is 'image', validate the upload (optional so we don't force re-upload every time)
            'logo_image'    => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',

            'primary_email' => 'nullable|email',
            'primary_phone' => 'nullable|string',
            'address'       => 'nullable|string',
            'map_iframe_url' => 'nullable|url',
            'footer_text'   => 'nullable|string',
            'email_notifications'      => 'required|boolean',
            'fund_applications_alerts' => 'required|boolean',
            'message_alerts'           => 'required|boolean',
            'maintenance_mode'         => 'required|boolean',
            'consultancy_alerts'       => 'required|boolean',

        ];
    }
}
