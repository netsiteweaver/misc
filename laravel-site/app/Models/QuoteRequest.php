<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'engine',
        'part_name',
        'quantity',
        'notes',
        'preferred_contact',
        'status',
        'source',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];
}
