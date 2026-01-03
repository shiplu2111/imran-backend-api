<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'date' => $this->created_at->format('Y-m-d'),
        ];
    }
}
