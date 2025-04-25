<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_bank', 'rib', 'iban', 'swift', 'type_compt', 'user_id',
    ];

    // Relationship: A compte belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}