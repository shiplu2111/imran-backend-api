<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultancyInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'type'         => $this->type,
            'page_heading' => $this->page_heading,
            'sub_heading'  => $this->sub_heading,
            'payment_information' => $this->payment_information,
            'sections'     => $this->sections, // Returns JSON array
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
