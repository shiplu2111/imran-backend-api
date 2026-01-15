<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CvSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Accessor for Full URL
    public function getCvUrlAttribute()
    {
        return $this->cv_file ? asset('storage/' . $this->cv_file) : null;
    }
}
