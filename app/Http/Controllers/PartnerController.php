<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Resources\PartnerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    // PUBLIC: List Partners
    public function index()
    {
        return PartnerResource::collection(Partner::orderBy('sort_order')->get());
    }

    // PROTECTED: Create
    public function store(StorePartnerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['logo'] = $file->storeAs('partners', $filename, 'public');
        }

        $partner = Partner::create($data);
        return new PartnerResource($partner);
    }

    // PROTECTED: Update
    public function update(StorePartnerRequest $request, Partner $partner)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            // Upload new
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['logo'] = $file->storeAs('partners', $filename, 'public');
        }

        $partner->update($data);
        return new PartnerResource($partner);
    }

    // PROTECTED: Delete
    public function destroy(Partner $partner): JsonResponse
    {
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();
        return response()->json(['message' => 'Partner deleted successfully']);
    }
}
