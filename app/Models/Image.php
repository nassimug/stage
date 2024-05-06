<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['projet_id', 'equipement_id', 'path'];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
