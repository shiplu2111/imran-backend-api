<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'published' => 'boolean',
        'date' => 'date',
    ];
    protected static function booted()
    {
        static::saving(function ($blog) {
            // Only generate slug if title is present and slug is empty
            if ($blog->title) {
                // Creates "My Blog Title" -> "my-blog-title"
                $baseSlug = Str::slug($blog->title);

                // Simple logic to handle updates:
                // If you want to force update the slug when title changes:
                $blog->slug = $baseSlug;

                // (Optional: Advanced logic needed here if you expect duplicate titles)
            }
        });
    }

    // 2. USE SLUG IN URL (Route Binding)
    // This makes: api/blogs/my-blog-post work instead of api/blogs/1
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // Relationship to your EXISTING Category model
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Image URL Accessor
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
