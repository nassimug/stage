<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUsers(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $query = User::query();

    // Filtre par texte de recherche
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'LIKE', "%{$search}%")
              ->orWhere('prenom', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    // Filtre par rôle
    if ($request->has('role') && !empty($request->role)) {
        $query->where('role', $request->role);
    }

    $users = $query->paginate(8);

    return view('users.index', compact('users'));
}



    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:utilisateurs,email',
        'role' => 'required|string|in:chercheur,enseignant,etudiant,admin',
        'mdp' => 'required|string|confirmed',
    ]);

    // Création du nouvel utilisateur
    User::create([
        'nom' => $validatedData['nom'],
        'email' => $validatedData['email'], 
        'role' => $validatedData['role'],
        'mdp' => Hash::make($validatedData['mdp']), // Hacher le mot de passe
    ]);

    // Redirection vers la liste des utilisateurs
    return redirect()->route('users.list')->with('success', 'Utilisateur créé avec succès.');
}
    public function create()
    {
        return view('users.create');
    }


    public function edit(User $user)
{
    

    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'role' => 'required|string|in:chercheur,enseignant,etudiant,admin',
    ]);

    // Mise à jour de l'utilisateur
    $user->update($validatedData);

    return redirect()->route('users.list')->with('success', 'Utilisateur modifié avec succès.');
}

public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('users.list')->with('success', 'Utilisateur supprimé avec succès.');
}

}