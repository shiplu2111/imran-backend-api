<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoundationSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'                => $this->name,
            'tagline'             => $this->tagline,
            'year_established'    => $this->year_established,
            'registration_number' => $this->registration_number,

            'mission'             => $this->mission,
            'vision'              => $this->vision,

            'email'               => $this->email,
            'phone'               => $this->phone,
            'address'             => $this->address,

            'services'            => $this->services, // Returns JSON array

            'cta_text'            => $this->cta_text,
            'logo_url'            => $this->logo ? asset('storage/' . $this->logo) : null,

            'updated_at'          => $this->updated_at->diffForHumans(),
        ];
    }
}
