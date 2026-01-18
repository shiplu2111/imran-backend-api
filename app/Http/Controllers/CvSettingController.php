<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use App\Http\Requests\UpdateCvSettingRequest;
use App\Http\Resources\CvSettingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvSettingController extends Controller
{
    // PUBLIC: Get PDF Link
    public function index()
    {
        $settings = CvSetting::firstOrCreate(['id' => 1]);
        return new CvSettingResource($settings);
    }

    // PROTECTED: Upload PDF
    public function update(UpdateCvSettingRequest $request)
    {
        $settings = CvSetting::firstOrCreate(['id' => 1]);
        $data = $request->validated();

        if ($request->hasFile('cv_file')) {
            // Delete old file
            if ($settings->cv_file && Storage::disk('public')->exists($settings->cv_file)) {
                Storage::disk('public')->delete($settings->cv_file);
            }
            // Upload new
            $file = $request->file('cv_file');
            $filename = 'resume_' . time() . '.' . $file->getClientOriginalExtension();
            $data['cv_file'] = $file->storeAs('cv_files', $filename, 'public');
        }

        $settings->update($data);
        return new CvSettingResource($settings);
    }

    public function download()
    {
        $settings = CvSetting::first();

        // Check if file exists
        if (!$settings || !$settings->cv_file || !Storage::disk('public')->exists($settings->cv_file)) {
            return response()->json(['message' => 'CV not found'], 404);
        }

        // Return the download response
        // 1st arg: File path
        // 2nd arg: The name the user will see (Hides the messy timestamp name)
        return Storage::disk('public')->download(
            $settings->cv_file,
            'MD_Imranuzzaman_CV.pdf'
        );
    }
}
