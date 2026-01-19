<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    // Allow all fields to be updated
    protected $guarded = ['id'];

    // Optional: Auto-append full image URL
    // access via: $setting->logo_image_url
    protected $appends = ['logo_image_url'];

    public function getLogoImageUrlAttribute()
    {
        return $this->logo_image ? asset('storage/' . $this->logo_image) : null;
    }
}
