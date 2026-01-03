<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'type'        => $this->type, // useful for frontend icons (e.g. money icon for donation)
            'time_ago'    => $this->created_at->diffForHumans(), // "5 min ago"
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
