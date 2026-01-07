<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiographyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'             => $this->name,
            'headline'         => $this->headline,
            'short_bio'        => $this->short_bio,
            'full_bio'         => $this->full_bio,

            'current_location' => $this->current_location,
            'hometown'         => $this->hometown,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'birthday'         => $this->birthday ? $this->birthday->format('F d, Y') : null, // "January 15, 1992"

            'image_url'        => $this->image ? asset('storage/' . $this->image) : null,
        ];
    }
}
