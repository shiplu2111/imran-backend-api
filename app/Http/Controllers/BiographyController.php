<?php

namespace App\Http\Controllers;

use App\Models\Biography;
use App\Http\Requests\UpdateBiographyRequest;
use App\Http\Resources\BiographyResource;
use App\Traits\UploadsImages;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    use UploadsImages;

    // PUBLIC: Get Profile
    public function index()
    {
        // Always get the first record, or create a blank one if missing
        $bio = Biography::firstOrCreate(['id' => 1]);
        return new BiographyResource($bio);
    }

    // PROTECTED: Update Profile
    public function update(UpdateBiographyRequest $request)
    {
        $bio = Biography::firstOrCreate(['id' => 1]);

        $data = $request->validated();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage(
                $request->file('image'),
                $bio->image,
                'biography' // Folder name
            );
        }

        $bio->update($data);

        return new BiographyResource($bio);
    }
}
