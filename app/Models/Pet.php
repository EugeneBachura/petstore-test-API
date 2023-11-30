<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    // Not use timestamps
    public $timestamps = false;

    // Fillable-attributes
    protected $fillable = [
        'name',
        'status',
        'photoUrls',
    ];

    // photoUrls must be array
    protected $casts = [
        'photoUrls' => 'array',
    ];
}
