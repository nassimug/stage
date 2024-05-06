<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $fillable = ['nom', 'description','aperçu', 'spécifications','caractéristiques',
    'utilisation' ,'téléchargements','type', 'status', 'image', 'date_ajout'];
    
    // Relation many-to-many avec Plateformes
    public function plateformes()
    {
        return $this->belongsToMany(Plateforme::class, 'equipements_plateformes');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
   
}



