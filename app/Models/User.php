<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $fillable = ['nom', 'prenom', 'email', 'mdp', 'role', 'profile_image']; // Ajouter 'profile_image' dans $fillable
    protected $hidden = ['mdp'];
    public $timestamps = false;  // Désactive la gestion automatique des timestamps

    public function getAuthPassword()
    {
        return $this->mdp;
    }
}
