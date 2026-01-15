<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Http\Resources\SocialLinkResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    // PUBLIC: List Links
    public function index(Request $request)
    {
        $query = SocialLink::orderBy('sort_order');

        // Only show active links to public users
        if (!$request->user()) {
            $query->where('is_active', true);
        }

        return SocialLinkResource::collection($query->get());
    }

    // PROTECTED: Create
    public function store(StoreSocialLinkRequest $request)
    {
        $socialLink = SocialLink::create($request->validated());
        return new SocialLinkResource($socialLink);
    }

    // PROTECTED: Update
    public function update(StoreSocialLinkRequest $request, SocialLink $socialLink)
    {
        $socialLink->update($request->validated());
        return new SocialLinkResource($socialLink);
    }

    // PROTECTED: Delete
    public function destroy(SocialLink $socialLink): JsonResponse
    {
        $socialLink->delete();
        return response()->json(['message' => 'Social link deleted successfully']);
    }
}
