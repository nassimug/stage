<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plateforme;
use App\Models\Projet;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    // app/Http/Controllers/ProjetController.php

    public function index()
    {
        $request = request(); 
          $query = Projet::query();

        // Filtre par plateforme
        if ($request->has('plateforme') && !empty($request->plateforme)) {
            $plateforme = strtolower($request->plateforme); // Convertir en minuscules
            if ($plateforme === 'terrestre' || $plateforme === 'drone') {
                $query->whereHas('plateforme', function ($q) use ($plateforme) {
                    $q->where('type', ucfirst($plateforme)); // Mettre en majuscule la première lettre
                });
            }
        }
        // Filtre par recherche
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

        // Récupérer tous les projets avec les plateformes associées pour éviter le problème N+1
        $projets = $query->with('plateforme')->paginate(5);
    return view('projets.index', compact('projets'));
    }


    public function create()
    {
        $plateformes = Plateforme::find([1, 2]);
        return view('projets.create', compact('plateformes'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'plateforme_id' => 'exists:plateformes,id',
            'introduction' => 'required',
            'description' => 'required',
        ]);

        $projet = Projet::create($request->all());

        return redirect()->route('projets.index')->with('success', 'Projet créé avec succès.');
    }

    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();

        return redirect()->route('projets.index')->with('success', 'Projet supprimé avec succès.');
    }

    public function show($id)
    {
        $projet = Projet::with('plateforme')->findOrFail($id);
        return view('projets.show', compact('projet'));
    }

    public function edit($id)
    {
        $projet = Projet::findOrFail($id);
        $plateformes = Plateforme::find([1, 2]);
        return view('projets.edit', compact('projet', 'plateformes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'plateforme_id' => 'required|exists:plateformes,id',
            'introduction' => 'required',
            'description' => 'required',
        ]);

        $projet = Projet::findOrFail($id);
        $projet->update($request->all());

        return redirect()->route('projets.index')->with('success', 'Projet modifié avec succès.');
    }

    public function details($id)
    {
        $projet = Projet::findOrFail($id);
        return view('projets.details', compact('projet'));

    }


}
