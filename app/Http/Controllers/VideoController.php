<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Resources\VideoResource;
use App\Traits\UploadsImages; // Import Trait
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    use UploadsImages; // Enable the Trait

    /**
     * Display a listing of the resource.
     * Default: Returns only 'published' videos.
     * Admin: Send ?all=true to see drafts and archived videos.
     */
    public function index(Request $request)
    {
        $query = Video::with('category')->latest();

        // Filter: Show only 'published' unless '?all=true' is present in URL
        if ($request->has('all')) {
        // No filter applied, returns Published + Draft + Archived
        } elseif ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'published');
        }

        return VideoResource::collection($query->get());
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
            'video_url'   => 'required|url', // YouTube/Vimeo link
            'duration'    => 'required|string',
            'tags'        => 'array',
            'status'      => 'in:published,draft,archived',
        ]);

        // Default to 'published'
        if (empty($validated['status'])) {
            $validated['status'] = 'published';
        }


        $video = Video::create($validated);

        return response()->json([
            'message' => 'Video added successfully!',
            'data'    => new VideoResource($video)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $video = Video::with('category')->find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        return new VideoResource($video);
    }

    /**
     * Update the specified resource.
     * Note: Use POST method with _method=PUT for file uploads.
     */
    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        $validated = $request->validate([
            'title'       => 'string|max:255',
            'description' => 'string',
            'category_id' => 'exists:categories,id',
            'date'        => 'date',
            'video_url'   => 'url',
            'duration'    => 'string',
            'tags'        => 'array',
            'status'      => 'in:published,draft,archived',
        ]);


        $video->update($validated);

        return response()->json([
            'message' => 'Video updated successfully!',
            'data'    => new VideoResource($video)
        ]);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }



        $video->delete();

        return response()->json(['message' => 'Video deleted successfully!']);
    }
}
