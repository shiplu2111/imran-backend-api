<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultancyInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Auto-convert JSON column to PHP Array
    protected $casts = [
        'sections' => 'array',
    ];

    // Allow finding by 'type' in the URL (e.g., api/consultancy-info/ruminants)
    public function getRouteKeyName()
    {
        return 'type';
    }
}
