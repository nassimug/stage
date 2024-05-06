<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs,email', // Remplacer 'login' par 'email'
            'mdp' => 'required|string|min:6|confirmed', // Assurez-vous d'avoir un minimum de sécurité pour les mots de passe
            'role' => 'required|string|in:chercheur,enseignant,etudiant'
        ]);

        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'], // Utiliser 'email' ici
            'mdp' => Hash::make($validatedData['mdp']),
            'role' => $validatedData['role']
        ]);

        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }

}
