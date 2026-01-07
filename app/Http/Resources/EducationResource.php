<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id'                 => $this->id,
        'degree'             => $this->degree,
        'field_of_study'     => $this->field_of_study,
        'institution'        => $this->institution,
        'location'           => $this->location,
        'start_date'         => $this->start_date,
        'end_date'           => $this->end_date,
        'currently_pursuing' => (bool) $this->currently_pursuing,
        // Frontend Helper: "2018 - 2020" or "2023 - Present"
        'duration'           => $this->start_date . ' - ' . ($this->currently_pursuing ? 'Present' : $this->end_date),
    ];
}
}
