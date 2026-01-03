<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category ? $this->category->name : 'Unknown',
            'category_id' => (string) $this->category_id,
            'date' => $this->date->format('Y-m-d'),

            // Assuming video_url is an external link (YouTube).
            // If it's a local upload, wrap it in asset(): asset('storage/' . $this->video_url)
            'videoUrl' => $this->video_url,

             'duration' => $this->duration,
            'tags' => $this->tags,
            'status' => $this->status,
        ];
    }
}
