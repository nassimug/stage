<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'identifiant', 'date_debut', 'date_fin', 'equipement_id', 'user_id', 'statut', 'commentaire'
    ];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}