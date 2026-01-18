<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'category'   => $this->category,
            'logo_url'   => $this->logo ? asset('storage/' . $this->logo) : null,
            // Fallback Initials for Frontend (e.g., "LU" for Lincoln University)
            'initials'   => $this->getInitials($this->name),
            'website'    => $this->website,
            'sort_order' => $this->sort_order,
        ];
    }

    // Helper to generate initials like "Lincoln University" -> "LU"
    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2); // Return first 2 letters
    }
}
