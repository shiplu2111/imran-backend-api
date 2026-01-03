<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    // PUBLIC: Get all news
    public function index()
    {
        $news = News::with('category')->latest()->get();
        return NewsResource::collection($news);
    }

    // PROTECTED: Create News
    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->validated());
        return new NewsResource($news->load('category'));
    }

    // PUBLIC: Get Single News
    public function show(News $news)
    {
        return new NewsResource($news->load('category'));
    }

    // PROTECTED: Update News
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());
        return new NewsResource($news->load('category'));
    }

    // PROTECTED: Delete News
    public function destroy(News $news): JsonResponse
    {
        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }

    // PROTECTED: Toggle Publish Status
    public function togglePublish(News $news): JsonResponse
    {
        $news->update(['published' => !$news->published]);

        $status = $news->published ? 'published' : 'unpublished';

        return response()->json([
            'message' => "News {$status} successfully",
            'data' => new NewsResource($news)
        ]);
    }
}
