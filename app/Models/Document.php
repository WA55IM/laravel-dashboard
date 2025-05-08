<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'confidence', 'fields', 'path'
    ];

    protected $casts = [
        'fields' => 'array'
    ];
}
