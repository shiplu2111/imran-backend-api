<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'date',
        'video_url',
        'duration',
        'tags',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'date' => 'date:Y-m-d',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
