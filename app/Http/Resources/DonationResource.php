<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'donor' => $this->donor,
            'email' => $this->email,
            'amount' => (float) $this->amount, // Return as number, not string
            'method' => $this->method,
            'date' => $this->date->format('Y-m-d'),
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
