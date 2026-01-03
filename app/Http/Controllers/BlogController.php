<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Traits\UploadsImages;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use UploadsImages;

    // PUBLIC: Get all blogs
    public function index()
    {
        // Eager load category to avoid N+1 issues
        $blogs = Blog::with('category')->latest()->get();
        return BlogResource::collection($blogs);
    }

    // PROTECTED: Create
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        $data['author'] = $request->user()->name;
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), null, 'blogs');
        }

        $blog = Blog::create($data);

        return new BlogResource($blog->load('category'));
    }

    // PUBLIC: Show Single
    public function show(Blog $blog)
    {
        return new BlogResource($blog->load('category'));
    }

    // PROTECTED: Update
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['author'] = $request->user()->name;
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage(
                $request->file('image'),
                $blog->image,
                'blogs'
            );
        }

        $blog->update($data);

        return new BlogResource($blog->load('category'));
    }

    // PROTECTED: Delete
    public function destroy(Blog $blog): JsonResponse
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }

    public function togglePublish(Blog $blog): JsonResponse
    {
        $blog->update([
            'published' => !$blog->published
        ]);

        $status = $blog->published ? 'published' : 'unpublished';

        return response()->json([
            'message' => "Blog {$status} successfully",
            'data' => new BlogResource($blog->load('category'))
        ]);
    }
}
