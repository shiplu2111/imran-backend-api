<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Http\Requests\StoreHobbyRequest;
use App\Http\Resources\HobbyResource;
use App\Traits\UploadsImages; // Use this if you have the trait, otherwise logic is below
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HobbyController extends Controller
{
    // PUBLIC: List Hobbies
    public function index()
    {
        // Return sorted by your manual order
        return HobbyResource::collection(Hobby::orderBy('sort_order')->get());
    }

    // PROTECTED: Create
    public function store(StoreHobbyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('hobbies', $filename, 'public');
        }

        $hobby = Hobby::create($data);

        return new HobbyResource($hobby);
    }

    // PROTECTED: Update
    public function update(StoreHobbyRequest $request, Hobby $hobby)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // 1. Delete old image
            if ($hobby->image && Storage::disk('public')->exists($hobby->image)) {
                Storage::disk('public')->delete($hobby->image);
            }
            // 2. Upload new
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('hobbies', $filename, 'public');
        }

        $hobby->update($data);

        return new HobbyResource($hobby);
    }

    // PROTECTED: Delete
    public function destroy(Hobby $hobby): JsonResponse
    {
        if ($hobby->image && Storage::disk('public')->exists($hobby->image)) {
            Storage::disk('public')->delete($hobby->image);
        }

        $hobby->delete();

        return response()->json(['message' => 'Hobby deleted successfully']);
    }
}
