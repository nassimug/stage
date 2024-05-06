<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email', // Utiliser 'email' à la place de 'login'
            'mdp' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['mdp']], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Les informations d identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(route('dashboard'));
    }


    public function showChangePasswordForm()
{
    return view('auth.change-password');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->mdp)) {
        return back()->withErrors(['current_password' => 'Votre mot de passe actuel ne correspond pas à celui que vous avez fourni.']);
    }

    $user->mdp = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Votre mot de passe a été changé avec succès.');
}

public function showProfile()
{
    $user = Auth::user();
    return view('auth.profil-edit', compact('user'));
}

public function updateProfile(Request $request)
{
    $request->validate([
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
}
  public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Taille maximale de 2MB pour l'image
        ]);

        // Stocker l'image dans le dossier 'public' de Laravel
        $path = $request->file('profile_image')->store('public');

        // Enregistrer le chemin d'accès de l'image dans la base de données pour l'utilisateur actuellement connecté
        $user = Auth::user();
        $user->profile_image = Storage::url($path);
        $user->save();

        return back()->with('success', 'Image de profil téléversée avec succès.');
    }
    


}
