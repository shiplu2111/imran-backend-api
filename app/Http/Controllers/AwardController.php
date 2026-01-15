<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Http\Resources\AwardResource;

class AwardController extends Controller
{
    public function index() {
        return AwardResource::collection(Award::orderBy('year', 'desc')->get());
    }

    public function store(StoreAwardRequest $request) {
        return new AwardResource(Award::create($request->validated()));
    }

    public function update(StoreAwardRequest $request, Award $award) {
        $award->update($request->validated());
        return new AwardResource($award);
    }

    public function destroy(Award $award) {
        $award->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
