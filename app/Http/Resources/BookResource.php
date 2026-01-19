<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'author'         => $this->author,
            'description'    => $this->description,
            'published_year' => $this->published_year,
            'type'           => $this->type,

            // Stats
            'read_count'     => (int) $this->read_count,
            'download_count' => (int) $this->download_count,

            // URLs
            'thumbnail_url'  => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
            // We provide the API download link instead of direct file path to track counts
            // 'download_url'   => route('books.download', $this->id),

            'is_published'   => (bool) $this->is_published,
            'created_at'     => $this->created_at->format('Y-m-d'),
        ];
    }
}
