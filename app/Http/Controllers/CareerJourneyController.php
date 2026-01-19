<?php

namespace App\Http\Controllers;

use App\Models\CareerJourney;
use App\Http\Requests\StoreCareerJourneyRequest;
use App\Http\Requests\UpdateCareerJourneyRequest;

class CareerJourneyController extends Controller
{
    // Public List (Ordered by Year or Sort Order)
    public function index()
    {
        return CareerJourney::orderBy('sort_order', 'asc')->get();
    }

    // Admin: Create
    public function store(StoreCareerJourneyRequest $request)
    {
        $journey = CareerJourney::create($request->validated());
        return response()->json($journey, 201);
    }

    // Admin: Show
    public function show(CareerJourney $careerJourney)
    {
        return $careerJourney;
    }

    // Admin: Update
    public function update(UpdateCareerJourneyRequest $request, CareerJourney $careerJourney)
    {
        $careerJourney->update($request->validated());
        return response()->json($careerJourney);
    }

    // Admin: Delete
    public function destroy(CareerJourney $careerJourney)
    {
        $careerJourney->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
