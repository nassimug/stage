@extends('layouts.app')

@section('title', $projet->nom)

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $projet->nom }}</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>{{ $projet->plateforme->nom }}</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<div class="container">
    <div class="my-4">
        <p><strong></strong> {!! $projet->description !!}</p>
    </div>
    <!-- Bouton pour revenir à la liste des projets -->
    <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-secondary">Voir le projet</a>
</div>
@endsection
