<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Image;
use App\Models\Projet;
use Illuminate\Support\Facades\Storage;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::with('images')->paginate(12);
        return view('equipements.index', compact('equipements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'nullable',
            'description' => 'required',
            'aperçu' => 'required',
            'spécifications' => 'required',
            'caractéristiques' => 'required',
            'utilisation' => 'required',
            'téléchargements' => 'required',
            'images.*' => 'image', 
        ]);

        $equipement = new Equipement();
        $equipement->nom = $request->nom;
        $equipement->description = $request->description;
        $equipement->aperçu = $request->aperçu;
        $equipement->spécifications = $request->spécifications;
        $equipement->caractéristiques = $request->caractéristiques;
        $equipement->utilisation = $request->utilisation;
        $equipement->téléchargements = $request->téléchargements;

        
        $equipement->save(); // Sauvegardez d'abord l'équipement pour obtenir son ID

        // Attach the equipment to the project
    $projet = Projet::findOrFail($request->projet_id);
    $projet->equipements()->save($equipement);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/equipements');
                $equipement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('equipements.index')->with('success', 'Équipement créé avec succès.');
    }

    public function create()
    {
        $projets = Projet::all(); // Récupère tous les projets
        return view('equipements.create', compact('projets'));
       
    }

    public function destroy($id)
    {
        $equipement = Equipement::findOrFail($id);
        // Supprimez les images associées si nécessaire
        foreach ($equipement->images as $image) {
            Storage::delete($image->path);
            $image->delete(); // Supprimez l'enregistrement de l'image de la base de données
        }
        $equipement->delete();

        return back()->with('success', 'Équipement supprimé avec succès.');
    }

    public function reserve($id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->status = 'reserve';
        $equipement->save();

        return back()->with('success', 'Équipement réservé avec succès.');
    }

    public function edit($id)
    {
        $equipement = Equipement::findOrFail($id);
        return view('equipements.edit', compact('equipement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'aperçu' => 'required',
            'spécifications' => 'required',
            'caractéristiques' => 'required',
            'utilisation' => 'required',
            'téléchargements' => 'required',
            'images.*' => 'image', // Valide chaque fichier dans le tableau d'images
        ]);

        $equipement = Equipement::findOrFail($id);
        $equipement->nom = $request->nom;
        $equipement->description = $request->description;
        $equipement->aperçu = $request->aperçu;
        $equipement->spécifications = $request->spécifications;
        $equipement->caractéristiques = $request->caractéristiques;
        $equipement->utilisation = $request->utilisation;
        $equipement->téléchargements = $request->téléchargements;

        // Vérifie si de nouvelles images sont téléchargées
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/equipements');
                
                $equipement->images()->create(['path' => $path]);
            }
        }

        $equipement->save();

        return redirect()->route('equipements.index')->with('success', 'Équipement modifié avec succès.');
    }

    public function destroyImage($id)
    {
        $image = Image::findOrFail($id);
        Storage::delete($image->path);
        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }

    public function show($id)
    {
        
        $equipement = Equipement::findOrFail($id);
        return view('equipements.show', compact('equipement'));
    }


}