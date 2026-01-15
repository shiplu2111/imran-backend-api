<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Resources\PublicationResource;

class PublicationController extends Controller
{
    public function index() {
        return PublicationResource::collection(Publication::orderBy('year', 'desc')->get());
    }

    public function store(StorePublicationRequest $request) {
        return new PublicationResource(Publication::create($request->validated()));
    }

    public function update(StorePublicationRequest $request, Publication $publication) {
        $publication->update($request->validated());
        return new PublicationResource($publication);
    }

    public function destroy(Publication $publication) {
        $publication->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
