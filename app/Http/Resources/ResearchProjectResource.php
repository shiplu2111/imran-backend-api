<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResearchProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'status'       => $this->status, // "Ongoing" or "Completed"

            // Raw Dates
            'start_date'   => $this->start_date,
            'end_date'     => $this->end_date,
            'is_current'   => (bool) $this->is_current,

            // Formatted Duration: "2023 - Present" or "2019 - 2020"
            'duration'     => $this->start_date . ' - ' . ($this->is_current ? 'Present' : $this->end_date),

            'description'  => $this->description,
            'is_published' => (bool) $this->is_published,
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
