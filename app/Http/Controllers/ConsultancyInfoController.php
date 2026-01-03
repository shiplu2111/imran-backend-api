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
    public function show(ConsultancyInfo $consultancyInfo)
    {
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
