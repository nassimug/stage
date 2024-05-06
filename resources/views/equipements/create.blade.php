@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Ajouter un équipement</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>Admin</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<div class="container mt-4" style="margin-bottom:20px;">
    <div class="card shadow">
        
                <div class="card-header" style="background-color: #17a2b8; color: white;">
                    Ajouter un Nouvel Équipement
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('equipements.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de l'Équipement</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="projet_id" class="form-label">Projet Associé</label>
                            <select class="form-select" id="projet_id" name="projet_id" required>
                                @foreach($projets as $projet)
                                    <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image de l'Équipement</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                        </div>

                        <!-- Intégration de TinyMCE pour les champs de texte enrichi -->
                        @foreach (['description' => 'Description Détaillée', 'aperçu' => 'Aperçu', 'spécifications' => 'Spécifications', 'caractéristiques' => 'Caractéristiques', 'utilisation' => 'Utilisation', 'téléchargements' => 'Téléchargements'] as $field => $label)
                            <div class="mb-3">
                                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="{{ $field }}"></textarea>
                            </div>
                        @endforeach
                        
                        <button type="submit" class="btn btn-outline-primary w-100">Soumettre</button>
                    </form>
                </div>
    </div>
</div>

<!-- Script TinyMCE -->
<x-head.tinymce-config/>
@endsection
