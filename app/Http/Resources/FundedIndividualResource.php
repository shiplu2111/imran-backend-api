<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FundedIndividualResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // Only public safe data
            'id'             => $this->id,
            'name'           => $this->full_name,
            'support_type'   => $this->support_type, // "Academic Scholarship"
            'research_area'  => $this->research_area, // "Veterinary Medicine"
            'institution'    => $this->organization,  // "Bangladesh Agri..."
            'country'        => $this->country ?? 'Bangladesh', // Default if empty
            'year'           => $this->created_at->format('Y'), // "2024"

            // Prefer project_title, fallback to purpose if title is missing
            'project'        => $this->project_title ?? $this->purpose,
        ];
    }
}
