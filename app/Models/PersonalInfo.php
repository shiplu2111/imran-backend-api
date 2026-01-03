<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'designation',
        'short_bio',
        'current_position',
        'department',
        'hero_image',
        'footer_text',
    ];
}
