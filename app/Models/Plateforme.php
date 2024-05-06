<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plateforme extends Model
{
    use HasFactory;
    
    protected $fillable = ['nom', 'type', 'description', 'capacite'];

    // Relation avec Projets : une Plateforme peut avoir plusieurs Projets
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    // Relation many-to-many avec Equipements
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'equipements_plateformes');
    }
}