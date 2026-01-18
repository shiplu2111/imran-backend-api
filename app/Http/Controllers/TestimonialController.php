<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Resources\TestimonialResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    // PUBLIC: List Testimonials
    public function index(Request $request)
    {
        $query = Testimonial::orderBy('sort_order');

        // Only show active ones to public visitors
        if (!$request->user()) {
            $query->where('is_active', true);
        }

        return TestimonialResource::collection($query->get());
    }

    // PROTECTED: Create
    public function store(StoreTestimonialRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('testimonials', $filename, 'public');
        }

        $testimonial = Testimonial::create($data);
        return new TestimonialResource($testimonial);
    }

    // PROTECTED: Update (Use POST method with _method=PUT in FormData)
    public function update(StoreTestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            // Upload new
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('testimonials', $filename, 'public');
        }

        $testimonial->update($data);
        return new TestimonialResource($testimonial);
    }

    // PROTECTED: Delete
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully']);
    }
}
