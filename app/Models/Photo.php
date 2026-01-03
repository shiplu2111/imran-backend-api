<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'date',
        'image_url',
        'tags',
        'status',
    ];

    protected $casts = [
        'tags' => 'array', // Automatically convert JSON to Array
        'date' => 'date:Y-m-d',
    ];

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
