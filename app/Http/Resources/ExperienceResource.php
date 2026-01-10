<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'role'         => $this->role,
            'organization' => $this->organization,
            'location'     => $this->location,
            'description'  => $this->description,

            // Date Logic
            'start_date'   => $this->start_date,
            'end_date'     => $this->end_date,
            'is_current'   => (bool) $this->is_current,

            // Helper string for Frontend: "2023 - Present" or "2017 - 2018"
            'duration'     => $this->start_date . ' - ' . ($this->is_current ? 'Present' : $this->end_date),

            'is_published' => (bool) $this->is_published,
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
