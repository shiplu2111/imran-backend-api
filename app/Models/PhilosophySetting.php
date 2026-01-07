<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilosophySetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'core_values' => 'array', // Auto-converts JSON to Array
    ];
}
