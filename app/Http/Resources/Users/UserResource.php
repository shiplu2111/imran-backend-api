<?php

namespace App\Http\Resources\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'              => $this->name,
            'email'             => $this->email,
            'username'          => $this->username,
            'phone'             => $this->phone,
            'avatar'            => $this->avatar_url,
            'email_verified_at' => $this->email_verified_at,
        ];
    }
}
