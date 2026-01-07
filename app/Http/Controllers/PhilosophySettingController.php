<?php

namespace App\Http\Controllers;

use App\Models\PhilosophySetting;
use App\Http\Requests\UpdatePhilosophySettingRequest;
use App\Http\Resources\PhilosophySettingResource;
use Illuminate\Http\Request;

class PhilosophySettingController extends Controller
{
    // PUBLIC: Get Philosophy
    public function index()
    {
        // Provide defaults so it doesn't crash on empty DB
        $settings = PhilosophySetting::firstOrCreate(['id' => 1], [
            'quote' => 'Default Quote',
            'quote_author' => 'MD Imranuzzaman',
            'vision_title' => 'Vision for the Future',
            'vision_description' => 'Default vision...',
            'core_values' => []
        ]);

        return new PhilosophySettingResource($settings);
    }

    // PROTECTED: Update Philosophy
    public function update(UpdatePhilosophySettingRequest $request)
    {
        // FIX: Use updateOrCreate
        // This tries to find ID 1.
        // If found -> Updates it.
        // If NOT found -> Creates it using the validated data (which contains quote, vision, etc.)
        $settings = PhilosophySetting::updateOrCreate(
            ['id' => 1],
            $request->validated()
        );

        return new PhilosophySettingResource($settings);
    }
}
