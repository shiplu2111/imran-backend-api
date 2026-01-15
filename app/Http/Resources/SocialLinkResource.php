<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialLinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'platform'   => $this->platform,
            'url'        => $this->url,
            'icon'       => $this->icon, // Pass string to frontend
            'is_active'  => (bool) $this->is_active,
            'sort_order' => $this->sort_order,
        ];
    }
}

