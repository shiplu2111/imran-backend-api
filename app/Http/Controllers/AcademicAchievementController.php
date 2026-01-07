<?php

namespace App\Http\Controllers;

use App\Models\AcademicAchievement;
use App\Http\Requests\StoreAcademicAchievementRequest;
use App\Http\Resources\AcademicAchievementResource;
use Illuminate\Http\JsonResponse;

class AcademicAchievementController extends Controller
{
    public function index()
    {
        return AcademicAchievementResource::collection(AcademicAchievement::orderBy('sort_order')->get());
    }

    public function store(StoreAcademicAchievementRequest $request)
    {
        $achievement = AcademicAchievement::create($request->validated());
        return new AcademicAchievementResource($achievement);
    }
    public function update(StoreAcademicAchievementRequest $request, AcademicAchievement $academicAchievement)
    {
        $academicAchievement->update($request->validated());
        return new AcademicAchievementResource($academicAchievement);
    }
    public function destroy(AcademicAchievement $academicAchievement): JsonResponse
    {
        $academicAchievement->delete();
        return response()->json(['message' => 'Achievement deleted successfully']);
    }
}
