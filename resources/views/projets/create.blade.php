@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Créer un projet</h2>
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
                    Créer un Nouveau Projet
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('projets.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du Projet</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="plateforme_id" class="form-label">Plateforme</label>
                            <select class="form-select" id="plateforme_id" name="plateforme_id" required>
                                @foreach ($plateformes as $plateforme)
                                    <option value="{{ $plateforme->id }}">{{ $plateforme->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="introduction" class="form-label">Introduction</label>
                            <textarea class="form-control" id="myeditorinstance" name="introduction"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description Détaillée</label>
                            <textarea class="form-control" id="myeditorinstance" name="description"></textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-primary w-100">Créer Projet</button>
                    </form>
                </div>
          
    </div>
</div>

<!-- Script TinyMCE -->
<x-head.tinymce-config/>
@endsection
