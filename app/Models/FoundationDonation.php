<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationDonation extends Model
{
    use HasFactory;

    // --- ADD THIS BLOCK ---
    protected $fillable = [
        'name',
        'description',
        'provider_id',
        'status',
        'sort_order'
    ];
    // ----------------------
}
