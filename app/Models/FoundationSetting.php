<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FoundationSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'services' => 'array', // Auto-converts JSON to Array
    ];

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
}
