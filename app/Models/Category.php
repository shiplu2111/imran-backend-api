<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Photo;
use App\Models\Video;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'color'
    ];

    // --- Relationships ---

    // 1. Photos
    public function photos()
    {
        // Assuming you will create a 'Photo' model later
        // return $this->hasMany(Photo::class);
        // For now, I will comment this out to prevent errors until you create the Photo model
        return $this->hasMany(Photo::class);
    }

    // // 2. Videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    // // 3. Blogs
    // public function blogs()
    // {
    //     return $this->hasMany(\App\Models\Blog::class);
    // }

    // // 4. News
    // public function news()
    // {
    //     return $this->hasMany(\App\Models\News::class);
    // }
}
