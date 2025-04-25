<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'raison_sociale',
        'type',
        'adresse',
        'code_postal',
        'activite',
        'telephone',
        'blockage',
    ];

    // Fournisseur belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
