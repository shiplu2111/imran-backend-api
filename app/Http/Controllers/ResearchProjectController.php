<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use App\Http\Requests\StoreResearchProjectRequest;
use App\Http\Resources\ResearchProjectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResearchProjectController extends Controller
{
    // PUBLIC: List Projects
    public function index(Request $request)
    {
        $query = ResearchProject::orderBy('start_date', 'desc');

        // Show only published unless user is admin
        if (!$request->user()) {
            $query->where('is_published', true);
        }

        return ResearchProjectResource::collection($query->get());
    }

    // PROTECTED: Create
    public function store(StoreResearchProjectRequest $request)
    {
        $project = ResearchProject::create($request->validated());
        return new ResearchProjectResource($project);
    }

    // PROTECTED: Show
    public function show(ResearchProject $researchProject)
    {
        return new ResearchProjectResource($researchProject);
    }

    // PROTECTED: Update
    public function update(StoreResearchProjectRequest $request, ResearchProject $researchProject)
    {
        $researchProject->update($request->validated());
        return new ResearchProjectResource($researchProject);
    }

    // PROTECTED: Delete
    public function destroy(ResearchProject $researchProject): JsonResponse
    {
        $researchProject->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
