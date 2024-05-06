@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Modifier le Projet : <strong>{{ $projet->nom }}</strong></h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>Admin</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<div class="container mt-4" style="margin-bottom:20px;">
    <div class="card shadow">
        <div class="card-header" style="background-color:#17a2b8 ; color: white;">
            Détails du Projet
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('projets.update', $projet->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Projet</label>
                    <input type="text" class="form-control" id="nom" name="nom" required value="{{ $projet->nom }}">
                </div>

                <div class="mb-3">
                    <label for="plateforme_id" class="form-label">Plateforme</label>
                    <select class="form-select" id="plateforme_id" name="plateforme_id" required>
                        @foreach ($plateformes as $plateforme)
                            <option value="{{ $plateforme->id }}" {{ $plateforme->id == $projet->plateforme_id ? 'selected' : '' }}>{{ $plateforme->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea class="form-control" id="myeditorinstance" name="introduction" required>{{ $projet->introduction }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description Détaillée</label>
                    <textarea class="form-control" id="myeditorinstance" name="description" required>{{ $projet->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-outline-primary">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Script TinyMCE -->
<x-head.tinymce-config/>
@endsection
