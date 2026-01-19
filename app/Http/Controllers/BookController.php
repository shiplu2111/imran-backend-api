<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Traits\UploadsImages; // Assuming you have this trait for image
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    use UploadsImages;

    // PUBLIC: List Books (with Filter)
    public function index(Request $request)
    {
        $query = Book::query();
        if (!auth('api')->check()) {
            $query->where('is_published', true);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        return BookResource::collection($query->latest()->get());
    }

    // PUBLIC: Show Single (Increments "Read" Count)
    public function show(Book $book)
    {
    $book->increment('read_count');

    return new BookResource($book);
    }

    public function preview(Book $book)
    {
        // 1. Check if the file exists in storage
        if (!$book->pdf || !Storage::disk('public')->exists($book->pdf)) {
            return response()->json(['message' => 'PDF not found'], 404);
        }

        // $book->increment('download_count');

        $filename = str_replace(' ', '_', $book->title) . '.pdf';

        return Storage::disk('public')->download(
            $book->pdf,
            $filename
        );
    }
    // PUBLIC: Download PDF (Increments "Download" Count)
    public function download(Book $book)
    {
        // 1. Check if the file exists in storage
        if (!$book->pdf || !Storage::disk('public')->exists($book->pdf)) {
            return response()->json(['message' => 'PDF not found'], 404);
        }

        $book->increment('download_count');

        $filename = str_replace(' ', '_', $book->title) . '.pdf';

        return Storage::disk('public')->download(
            $book->pdf,
            $filename
        );
    }



    // PROTECTED: Create Book
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        // 1. Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), null, 'books/thumbnails');
        }

        // 2. Upload PDF (Standard Laravel Upload)
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['pdf'] = $file->storeAs('books/pdfs', $filename, 'public');
        }

        $book = Book::create($data);

        return new BookResource($book);
    }

    // PROTECTED: Update Book
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        // Update Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), $book->thumbnail, 'books/thumbnails');
        }

        // Update PDF
        if ($request->hasFile('pdf')) {
            // Delete old PDF
            if ($book->pdf && Storage::disk('public')->exists($book->pdf)) {
                Storage::disk('public')->delete($book->pdf);
            }
            // Upload new
            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['pdf'] = $file->storeAs('books/pdfs', $filename, 'public');
        }

        $book->update($data);

        return new BookResource($book);
    }

    // PROTECTED: Delete
    public function destroy(Book $book)
    {
        // Delete files
        if ($book->thumbnail) Storage::disk('public')->delete($book->thumbnail);
        if ($book->pdf) Storage::disk('public')->delete($book->pdf);

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }

}
