<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id, // React often prefers string IDs
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'date' => $this->date->format('Y-m-d'),
            'isRead' => (bool) $this->is_read, // Converting snake_case to camelCase
            'status' => $this->status,
        ];
    }
}
