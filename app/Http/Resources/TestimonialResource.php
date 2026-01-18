<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'position'    => $this->position,
            'institution' => $this->institution,
            'message'     => $this->message,
            'image_url'   => $this->image ? asset('storage/' . $this->image) : null, // Used for user photo
            'is_active'   => (bool) $this->is_active,
            'sort_order'  => $this->sort_order,
        ];
    }
}
