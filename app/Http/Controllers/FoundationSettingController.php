<?php

namespace App\Models;
namespace App\Http\Controllers;

use App\Models\FoundationSetting;
use App\Http\Requests\UpdateFoundationSettingRequest;
use App\Http\Resources\FoundationSettingResource;
use App\Traits\UploadsImages;
use Illuminate\Http\Request;

class FoundationSettingController extends Controller
{
    use UploadsImages;

    // PUBLIC: Get the settings (We always assume ID 1 for simplicity)
    public function index()
    {
        // Get the first record or create empty one if not exists
        $settings = FoundationSetting::firstOrCreate(['id' => 1]);
        return new FoundationSettingResource($settings);
    }

    // PROTECTED: Update the settings
    public function update(UpdateFoundationSettingRequest $request)
    {
        // Always update the first record
        $settings = FoundationSetting::firstOrCreate(['id' => 1]);

        $data = $request->validated();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImage(
                $request->file('logo'),
                $settings->logo,
                'foundation' // Folder name
            );
        }

        $settings->update($data);

        return new FoundationSettingResource($settings);
    }
}
