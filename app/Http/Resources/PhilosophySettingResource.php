<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhilosophySettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'quote'              => $this->quote,
            'quote_author'       => $this->quote_author,
            'vision_title'       => $this->vision_title,
            'vision_description' => $this->vision_description,
            'core_values'        => $this->core_values, // Returns the JSON array
        ];
    }
}
