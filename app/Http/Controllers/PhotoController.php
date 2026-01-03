<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Resources\PhotoResource;
use App\Traits\UploadsImages; // Import your Trait
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    use UploadsImages; // Enable the Trait

    /**
     * Display a listing of the resource.
     * * Default: Returns only 'published' photos.
     * Admin: Send ?all=true to see drafts and archived photos.
     */
    public function index(Request $request)
{
    $query = Photo::with('category')->latest();

    // ১. যদি 'all' থাকে (Admin Mode), তাহলে সব দেখাও (কোনো ফিল্টার নেই)
    if ($request->has('all')) {
        // No filter applied, returns Published + Draft + Archived
    }
    // ২. যদি নির্দিষ্ট 'status' চাওয়া হয় (যেমন: ?status=draft)
    elseif ($request->has('status')) {
        $query->where('status', $request->status);
    }
    // ৩. ডিফল্ট (Public Mode): শুধুমাত্র Published দেখাও
    else {
        $query->where('status', 'published');
    }

    return PhotoResource::collection($query->get());
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'date'        => 'required|date',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags'        => 'array',
            'status'      => 'in:published,draft,archived', // Renamed to status
        ]);

        // Default to 'published' if status is not sent
        if (empty($validated['status'])) {
            $validated['status'] = 'published';
        }

        // Upload Image using Trait
        $validated['image_url'] = $this->uploadImage($request->file('image'), null, 'photos');

        $photo = Photo::create($validated);

        return response()->json([
            'message' => 'Photo uploaded successfully!',
            'data'    => new PhotoResource($photo)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $photo = Photo::with('category')->find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        return new PhotoResource($photo);
    }

    /**
     * Update the specified resource in storage.
     * NOTE: Use POST method with _method=PUT in Postman/Frontend for file uploads.
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $validated = $request->validate([
            'title'       => 'string|max:255',
            'description' => 'string',
            'category_id' => 'exists:categories,id',
            'date'        => 'date',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags'        => 'array',
            'status'      => 'in:published,draft,archived',
        ]);

        // Handle Image Replacement
        if ($request->hasFile('image')) {
            // Trait handles deleting the old file ($photo->image_url) automatically
            $validated['image_url'] = $this->uploadImage(
                $request->file('image'),
                $photo->image_url,
                'photos'
            );
        }

        $photo->update($validated);

        return response()->json([
            'message' => 'Photo updated successfully!',
            'data'    => new PhotoResource($photo)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        // Manually delete the file (Trait is only for uploading)
        if ($photo->image_url) {
            Storage::disk('public')->delete($photo->image_url);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully!']);
    }
}
