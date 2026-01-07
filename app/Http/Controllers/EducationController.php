<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Resources\EducationResource;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    // PUBLIC: List Degrees (Ordered by newest first)
    public function index()
    {
        return EducationResource::collection(Education::orderBy('start_date', 'desc')->get());
    }

    // PROTECTED: Create
    public function store(StoreEducationRequest $request)
    {
        $education = Education::create($request->validated());
        return new EducationResource($education);
    }

    // PROTECTED: Update
    public function update(StoreEducationRequest $request, Education $education)
    {
        $education->update($request->validated());
        return new EducationResource($education);
    }

    // PROTECTED: Delete
    public function destroy(Education $education): JsonResponse
    {
        $education->delete();
        return response()->json(['message' => 'Degree deleted successfully']);
    }
}
