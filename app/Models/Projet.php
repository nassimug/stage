<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'introduction', 'description', 'plateforme_id',];

    public function plateforme()
    {
        return $this->belongsTo(Plateforme::class);
    }
    public function equipements()
    {
        return $this->hasMany(Equipement::class);
    }
   
    
}
