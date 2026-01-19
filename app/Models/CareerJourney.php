<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerJourney extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'year', 'title', 'description', 'sort_order'];
}
