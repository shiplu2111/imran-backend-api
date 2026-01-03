<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'full_name'      => $this->full_name,
            'phone'          => $this->phone,
            'email'          => $this->email,
            'type'           => $this->type,
            'message'        => $this->message,
            'date'           => $this->date ? $this->date->format('Y-m-d') : null,
            'payment_status' => $this->payment_status,
            'status'         => $this->status,
            'created_at'     => $this->created_at->toDateTimeString(),
        ];
    }
}
