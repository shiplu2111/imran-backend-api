<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor',
        'email',
        'amount',
        'method',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date:Y-m-d',
    ];
}
