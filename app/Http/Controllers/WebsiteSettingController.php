<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use App\Http\Requests\UpdateWebsiteSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    // 1. PUBLIC: Get Settings (For Header/Footer of Website)
    public function index()
    {
        // Always get the first row. If missing, return empty object.
        return WebsiteSetting::first() ?? response()->json(['message' => 'No settings found'], 404);
    }

    // 2. ADMIN: Update Settings
    public function update(UpdateWebsiteSettingRequest $request)
    {
        // Get the singleton record (ID 1)
        $settings = WebsiteSetting::firstOrFail();

        $data = $request->validated();

        // --- Handle Image Upload ---
        if ($request->hasFile('logo_image')) {
            // 1. Delete old image if exists
            if ($settings->logo_image && Storage::disk('public')->exists($settings->logo_image)) {
                Storage::disk('public')->delete($settings->logo_image);
            }

            // 2. Upload new image
            $file = $request->file('logo_image');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $data['logo_image'] = $file->storeAs('settings', $filename, 'public');
        }

        // Update database
        $settings->update($data);

        return response()->json([
            'message' => 'Website settings updated successfully',
            'data' => $settings
        ]);
    }
}
