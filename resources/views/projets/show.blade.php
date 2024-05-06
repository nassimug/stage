@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $projet->plateforme->nom }}</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>{{ $projet->plateforme->nom }}</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<div class="container">
    <div class="row">
        <!-- Main content for the project introduction -->
        <div class="col-md-9">
            <article>
                <h1><strong>{{ $projet->nom }}</strong></h1>
                <p>{!! $projet->introduction !!}</p>
            </article>

        
        </div>

        <!-- Sidebar for displaying linked equipment -->
        <div class="col-md-3">
    <aside>
        <header>
            <h3 style="text-align:center">Équipements liés</h3>
        </header>
        <hr class="sidebar-divider"> <!-- Horizontal divider -->
        <ul class="list-group">
            @foreach ($projet->equipements as $equipement)
            <li class="list-group-item d-flex align-items-center">
                <a href="{{ route('equipements.show', $equipement->id) }}" class="d-flex align-items-center">
                    @if($equipement->images->isNotEmpty())
                    <img src="{{ Storage::url($equipement->images->first()->path) }}" class="img-fluid mr-2"
                        alt="Image of {{ $equipement->nom }}" style="width: 50px; height: 50px; object-fit: cover;">
                    @endif
                    <span style="color: #17a2b8">{{ $equipement->nom }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
    <div class="more-info-button">
        <a href="{{ route('projets.details', $projet->id) }}" class="btn btn-info">En savoir plus sur ce projet</a>
    </div>
</div>

    </div>
</div>

<style>
/* Style de base pour la page */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #333;
}

.container {
    margin-top: 20px;
}



/* Styles pour le contenu principal */
/* Contenu de l'article */
article {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden; /* Prevents content from overflowing */
    border: 1px solid #17a2b8; /* Adds a border with color #17a2b8 */
}


/* Gère la taille des images dans l'article */
article img {
    max-width: 100%;
    /* Empêche les images de dépasser la largeur de leur conteneur */
    height: auto;
    /* Maintient le ratio aspect des images */
}


.btn-info {
    background-color: #17a2b8;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    transition: background-color 0.3s;
}

.btn-info:hover {
    background-color: #138496;
}

/* Styles spécifiques pour la sidebar */
aside {
   
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid #17a2b8;
}


.list-group-item {
    background-color: transparent;
    border: none;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.2s;
}

.list-group-item:hover {
    background-color: #e9ecef;
}

.list-group-item a {
    text-decoration: none;
    color: #333;
}

.carousel-item img {
    max-height: 200px;
    /* Adjust based on your layout */
    object-fit: cover;
    /* Ensures images cover the area appropriately */
}
.more-info-button {
    text-align: left; /* Aligns the button to the right, closer to the sidebar */
    padding: 10px 0; /* Provides some spacing */
}


.sidebar-divider {
    margin-top: 10px;
    margin-bottom: 10px;
    border-top: 2px solid #17a2b8; /* Using the same color as your links for consistency */
}

</style>
@endsection