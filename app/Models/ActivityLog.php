<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Helper to create a log entry easily from anywhere.
     * Usage: ActivityLog::log('Title', 'Description', 'type');
     */
    public static function log($title, $description, $type = 'info')
    {
        return self::create([
            'title'       => $title,
            'description' => $description,
            'type'        => $type,
        ]);
    }
}
