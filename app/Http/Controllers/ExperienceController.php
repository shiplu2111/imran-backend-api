<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Resources\ExperienceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    // PUBLIC: List Experiences
    public function index(Request $request)
    {
        $query = Experience::orderBy('start_date', 'desc');

        // If not admin/authorized, only show published
        // (You can also filter via query param ?all=true if admin)
        if (!$request->user()) {
             $query->where('is_published', true);
        }

        return ExperienceResource::collection($query->get());
    }

    // PROTECTED: Create
    public function store(StoreExperienceRequest $request)
    {
        $experience = Experience::create($request->validated());
        return new ExperienceResource($experience);
    }

    // PROTECTED: Show Single
    public function show(Experience $experience)
    {
        return new ExperienceResource($experience);
    }

    // PROTECTED: Update
    public function update(StoreExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return new ExperienceResource($experience);
    }

    // PROTECTED: Delete
    public function destroy(Experience $experience): JsonResponse
    {
        $experience->delete();
        return response()->json(['message' => 'Experience deleted successfully']);
    }
}
