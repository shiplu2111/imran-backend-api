<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'headline'     => $this->headline,
            'source'       => $this->source,
            'date'         => $this->date->format('Y-m-d'),
            'excerpt'      => $this->excerpt,

            // Map DB snake_case to frontend camelCase
            'externalLink' => $this->external_link,

            'category'     => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,

            'published'    => (bool) $this->published,
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
