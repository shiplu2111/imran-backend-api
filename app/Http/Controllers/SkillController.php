<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\SkillResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // PUBLIC: List Skills
    public function index(Request $request)
    {
        // Start Query
        $query = Skill::orderBy('sort_order');

        // If User is NOT logged in (Public Visitor), show ONLY published
        if (!$request->user()) {
            $query->where('is_published', true);
        }

        $skills = $query->get();

        if ($request->has('grouped')) {
            return response()->json(['data' => $skills->groupBy('category')]);
        }

        return SkillResource::collection($skills);
    }

    // PROTECTED: Create
    public function store(StoreSkillRequest $request)
    {
        $skill = Skill::create($request->validated());
        return new SkillResource($skill);
    }

    // PROTECTED: Update
    public function update(StoreSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());
        return new SkillResource($skill);
    }

    // PROTECTED: Delete
    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();
        return response()->json(['message' => 'Skill deleted successfully']);
    }
}
