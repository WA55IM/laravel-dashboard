<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id', 'code', 'raison_sociale', 'type_client', 'num_siret', 'adresse', 
        'matricule_fiscale', 'code_postal', 'activite', 'telephone', 'blockage', 
        'exomee', 'num_decision', 'date_debut', 'date_fin'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
