<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * Supports filtering: ?type=blog
     */
    public function index(Request $request)
    {
        $query = Category::latest();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        return CategoryResource::collection($query->get());
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:photo,video,blog,news',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:20',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Category created successfully!',
            'data' => new CategoryResource($category)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'type' => 'in:photo,video,blog,news',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'color' => 'string|max:20',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Category updated successfully!',
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Remove the specified resource (Safe Delete).
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // --- SAFETY CHECKS ---
        // We use try-catch to prevent crashing if the models don't exist yet
        try {
            // Check Photos
            if (class_exists(\App\Models\Photo::class) && $category->photos()->exists()) {
                return response()->json([
                    'message' => 'Cannot delete! This category contains Photos. Please delete them first.'
                ], 409); // 409 Conflict
            }

            // Check Videos
            if (class_exists(\App\Models\Video::class) && $category->videos()->exists()) {
                return response()->json([
                    'message' => 'Cannot delete! This category contains Videos.'
                ], 409);
            }

            // // Check Blogs
            // if (class_exists(\App\Models\Blog::class) && $category->blogs()->exists()) {
            //     return response()->json([
            //         'message' => 'Cannot delete! This category contains Blogs.'
            //     ], 409);
            // }

            //  // Check News
            // if (class_exists(\App\Models\News::class) && $category->news()->exists()) {
            //     return response()->json([
            //         'message' => 'Cannot delete! This category contains News.'
            //     ], 409);
            // }

        } catch (\Exception $e) {
            // If the relationship methods are missing in the Model, ignore and proceed
            // or log the error
        }

        // If we passed all checks, it is safe to delete
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully!'
        ]);
    }
}
