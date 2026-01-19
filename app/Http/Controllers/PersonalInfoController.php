<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use App\Traits\UploadsImages;
use App\Http\Resources\PersonalInfoResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PersonalInfoController extends Controller
{
    use UploadsImages;

    // GET: Fetch Data
    public function index()
    {
        $info = PersonalInfo::first();

        if (!$info) {
            return response()->json(['data' => null], 200);
        }

        return new PersonalInfoResource($info);
    }

    // POST: Create Data
    public function store(Request $request)
    {
        if (PersonalInfo::exists()) {
            return response()->json(['message' => 'Data already exists. Use update route.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'site_title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'shortBio' => 'required|string',
            'current_position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $personalInfo = new PersonalInfo();

        // Handle Image Upload
        if ($request->hasFile('hero_image')) {
            $imagePath = $this->uploadImage($request->file('hero_image'), null, 'hero_images');
            $personalInfo->hero_image = $imagePath;
        }

        $this->saveData($personalInfo, $request);

        return response()->json([
            'message' => 'Created successfully',
            'data' => new PersonalInfoResource($personalInfo)
        ], 201);
    }

    // POST: Update Data
    public function update(Request $request)
    {
        $personalInfo = PersonalInfo::first();

        if (!$personalInfo) {
            return response()->json(['message' => 'No record found to update'], 404);
        }

        $validator = Validator::make($request->all(), [
            'site_title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'shortBio' => 'required|string',
            'current_position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle Image Update (Delete old, upload new)
        if ($request->hasFile('hero_image')) {
            $imagePath = $this->uploadImage(
                $request->file('hero_image'),
                $personalInfo->hero_image,
                'hero_images'
            );

            if ($imagePath) {
                $personalInfo->hero_image = $imagePath;
            }
        }

        $this->saveData($personalInfo, $request);

        return response()->json([
            'message' => 'Updated successfully',
            'data' => new PersonalInfoResource($personalInfo)
        ]);
    }

    // DELETE: Remove Data
    public function destroy()
    {
        $personalInfo = PersonalInfo::first();

        if (!$personalInfo) {
            return response()->json(['message' => 'No record found'], 404);
        }

        // Delete image from storage
        if ($personalInfo->hero_image && Storage::disk('public')->exists($personalInfo->hero_image)) {
            Storage::disk('public')->delete($personalInfo->hero_image);
        }

        $personalInfo->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    // Helper to map request data to model
    private function saveData($model, $request)
    {
        $model->site_title = $request->site_title;
        $model->designation = $request->designation;
        $model->short_bio = $request->shortBio;
        $model->current_position = $request->current_position;
        $model->department = $request->department;
        $model->footer_text = $request->footer_text;
        $model->save();
    }
}
