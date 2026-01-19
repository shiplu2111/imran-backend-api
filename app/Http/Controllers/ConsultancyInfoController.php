<?php

namespace App\Http\Controllers;

use App\Models\ConsultancyInfo;
use App\Http\Requests\StoreConsultancyInfoRequest;
use App\Http\Resources\ConsultancyInfoResource;
use Illuminate\Http\JsonResponse;

class ConsultancyInfoController extends Controller
{
    // PUBLIC: Get all
    public function index()
    {
        return ConsultancyInfoResource::collection(ConsultancyInfo::all());
    }

    // PROTECTED: Create
    public function store(StoreConsultancyInfoRequest $request)
    {
        $info = ConsultancyInfo::create($request->validated());
        return new ConsultancyInfoResource($info);
    }

    // PUBLIC: Show Single (Finds by 'type')
   public function show($type)
{
    // 1. Clean the input (Remove spaces, convert to lowercase for comparison)
    $cleanType = trim($type);

    // 2. Search Case-Insensitive (Handles 'ruminants', 'Ruminants', 'RUMINANTS')
    // We use 'LIKE' which is case-insensitive in most SQL databases (MySQL/MariaDB)
    $consultancyInfo = ConsultancyInfo::where('type',  $cleanType)->first();

    // 3. Check if found
    if (!$consultancyInfo) {
        return response()->json([
            'message' => "Data not found. Searched for: '$cleanType'",
            'debug_hint' => "Check if the 'type' column in your database has hidden spaces."
        ], 404);
    }

    // 4. Return Resource
    return new ConsultancyInfoResource($consultancyInfo);
}

    // PROTECTED: Update
    public function update(StoreConsultancyInfoRequest $request, ConsultancyInfo $consultancyInfo)
    {
        $consultancyInfo->update($request->validated());
        return new ConsultancyInfoResource($consultancyInfo);
    }

    // PROTECTED: Delete
    public function destroy(ConsultancyInfo $consultancyInfo): JsonResponse
    {
        $consultancyInfo->delete();
        return response()->json(['message' => 'Consultancy Info deleted successfully']);
    }
}
