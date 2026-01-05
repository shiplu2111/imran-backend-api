<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FundApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'full_name'        => $this->full_name,
            'email'            => $this->email,
            'organization'     => $this->organization,
            'support_type'     => $this->support_type,
            'research_area' => $this->research_area,
            'amount_requested' => $this->amount_requested,
            'purpose'          => $this->purpose,
            'proposal_summary' => $this->proposal_summary,

            // Full URL to download file
            'document_url'     => $this->document ? asset('storage/' . $this->document) : null,

            'status'           => $this->status,
            'created_at'       => $this->created_at->toDateTimeString(),
        ];
    }
}
