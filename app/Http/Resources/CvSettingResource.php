<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CvSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'cv_url'      => $this->cv_file ? asset('storage/' . $this->cv_file) : null,
        'button_text' => $this->button_text,
        'is_published'=> (bool) $this->is_published,
    ];
}
}
