<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Http\Requests\StoreExpertiseRequest;
use App\Http\Resources\ExpertiseResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    // PUBLIC: List Areas
    public function index(Request $request)
    {
        $query = Expertise::orderBy('sort_order');

        // Only show active items to public users
        if (!$request->user()) {
            $query->where('is_active', true);
        }

        return ExpertiseResource::collection($query->get());
    }

    // PROTECTED: Create
    public function store(StoreExpertiseRequest $request)
    {
        $expertise = Expertise::create($request->validated());
        return new ExpertiseResource($expertise);
    }

    // PROTECTED: Update
    public function update(StoreExpertiseRequest $request, Expertise $expertise)
    {
        $expertise->update($request->validated());
        return new ExpertiseResource($expertise);
    }

    // PROTECTED: Delete
    public function destroy(Expertise $expertise): JsonResponse
    {
        $expertise->delete();
        return response()->json(['message' => 'Expertise deleted successfully']);
    }
}
