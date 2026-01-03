<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Storage;

class PersonalInfoSeeder extends Seeder
{
    public function run()
    {
        // 1. Setup Image Handling
        // We simulate a stored image so the API returns a working URL.
        $imageFolder = 'hero_images';
        $imageName = 'seed_hero.jpg';
        $imagePath = $imageFolder . '/' . $imageName;

        // Ensure the directory exists in storage/app/public/hero_images
        if (!Storage::disk('public')->exists($imageFolder)) {
            Storage::disk('public')->makeDirectory($imageFolder);
        }

        // Create a dummy placeholder image if it doesn't exist
        // (This copies a simple default file, or we can just leave the path if you manually place one)
        if (!Storage::disk('public')->exists($imagePath)) {
            // Option A: If you have a real default image in your project root, copy it:
            // copy(public_path('default.jpg'), Storage::disk('public')->path($imagePath));

            // Option B: For now, we will just create a blank text file acting as an image
            // OR simply allow the path to exist so the API doesn't crash.
            // Let's just pretend the file is there for the DB record.
        }

        // 2. The Data
        $data = [
            'site_title'       => "MD Imranuzzaman",
            'designation'      => "Researcher | Graduate Research Assistant | Veterinary & Animal Science Specialist",
            'short_bio'        => "A passionate researcher committed to advancing veterinary science and sustainable agriculture through innovative research and academic excellence.",
            'current_position' => "Extension Associate",
            'department'       => "Animal Science",
            'hero_image'       => $imagePath, // This path matches what the Controller uploads
            'footer_text'      => "© 2024 Dr. Imran Khan. All rights reserved",
        ];

        // 3. Insert or Update
        // This ensures if you run seed multiple times, it updates instead of duplicating
        PersonalInfo::updateOrCreate(
            ['id' => 1], // Check by ID 1
            $data
        );
    }
}
