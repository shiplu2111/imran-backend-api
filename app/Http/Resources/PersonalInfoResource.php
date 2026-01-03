<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'site_title' => $this->site_title,
            'designation' => $this->designation,
            'shortBio' => $this->short_bio, // Convert DB snake_case to frontend camelCase
            'current_position' => $this->current_position,
            'department' => $this->department,
            'hero_image' => $this->hero_image ? asset('storage/' . $this->hero_image) : null,
            'footer_text' => $this->footer_text,
        ];
    }
}
