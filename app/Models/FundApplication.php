<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FundApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Helper to get full Document URL
    public function getDocumentUrlAttribute()
    {
        return $this->document ? asset('storage/' . $this->document) : null;
    }
}
