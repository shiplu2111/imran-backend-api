<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'description' => $this->description,
            // Return category name directly for easy display, or full object
            'category' => $this->category ? $this->category->name : 'Unknown',
            'category_id' => (string) $this->category_id,
            'date' => $this->date->format('Y-m-d'),
            'imageUrl' => asset('storage/' . $this->image_url), // Full URL
            'tags' => $this->tags,
            'status' => $this->status,
        ];
    }
}
