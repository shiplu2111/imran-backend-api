<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'description' => $this->description,
            // Return full object or flattened data
            'category'    => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name, // Adjust 'name' to whatever column you use
            ] : null,
            'date'        => $this->date->format('Y-m-d'),
            'author'      => $this->author,
            'content'     => $this->content,
            'tags'        => $this->tags,
            'published'   => (bool) $this->published,
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
