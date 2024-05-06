@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Équipements</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>Équipements</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->
<div class="container" style="padding:20px">
    <div class="row">
        @foreach ($equipements as $equipement)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card">
                @if(auth()->check() && auth()->user()->role === 'admin')
                <form action="{{ route('equipements.destroy', $equipement->id) }}" method="POST" class="delete-icon"
                    onclick="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="padding: 0; background: transparent; border: none;">
                        <i class="fa fa-trash-alt fa-2x" style="color: #dc3545; "></i>
                    </button>
                </form>
                @endif
                <a href="{{ route('equipements.show', $equipement->id) }}">
                    @if($equipement->images->isNotEmpty())
                    <div id="carouselEquipement{{ $equipement->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($equipement->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </a>

                <div class="card-body">
                    <a href="{{ route('equipements.show', $equipement->id) }}" class="link"
                        style="text-decoration: none; color: inherit;">
                        <h6>{{ Str::limit($equipement->nom, 25, '...') }}</h6>
                    </a>
                    <div class="d-flex justify-content-between button-container">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('equipements.edit', $equipement->id) }}"
                            class="btn flex-fill" style="background-color:#17a2b8">Modifier</a>
                        @endif

                        @auth
                        <a href="{{ route('reservations.create', $equipement->id) }}" class="btn flex-fill" style="background-color:#17a2b8">Réserver</a>
                        @else
                        <a href="{{ route('login') }}" class="btn flex-fill" style="background-color:#17a2b8">
                            Réserver
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $equipements->links() }}
    </div>
</div>
<script>
function confirmDelete() {
    return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?');
}
</script>
<style>
.carousel-item {
    height: 200px; /* Fixe la hauteur du carousel */
}

.carousel-item img {
    width: 100%; /* Prend toute la largeur de son conteneur */
    height: 100%; /* Prend toute la hauteur de son conteneur */
    object-fit: cover; /* Assure que l'image couvre entièrement la zone sans être déformée */
    transform: scale(0.8); /* Dézoomer légèrement l'image */
    transition: transform 0.3s ease-in-out; /* Ajoute une transition douce */
}

.btn {
    width: 100%;
    background-color: #0056b3; /* Couleur de fond principale */
    border: none;
    color: white;
    padding: 12px 24px; /* Padding uniforme */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px; /* Taille de police uniforme */
    border-radius: 5px; /* Bordures arrondies */
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Transitions douces */
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Ombre subtile pour un effet 3D léger */
    text-transform: uppercase; /* Texte en majuscules pour un look plus dynamique */
}

.btn:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Ombre plus prononcée au survol */
}

.link h6:hover {
    color: #17a2b8; /* Change la couleur en bleu lorsque survolé */
}

.carousel-item img:hover {
    transform: scale(1.05); /* Agrandit l'image de 5% lorsqu'elle est survolée */
}

.card {
    border: none;
    background-color: #F5F5F5; /* Couleur de fond de la carte */
    box-shadow: 0 4px 8px rgba(0,0,0,0.15); /* Ombre pour donner de la profondeur */
    border-radius: 8px; /* Bordures arrondies */
    transition: box-shadow 0.3s ease-in-out; /* Transition douce pour l'ombre */
}

.card:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.2); /* Ombre plus forte au survol */
}

.delete-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10;
    color: #dc3545; /* Couleur de l'icône pour la suppression */
    cursor: pointer;
}

.delete-icon:hover {
    color: #c82335; /* Changement de couleur au survol pour une visibilité accrue */
}

.button-container {
    display: flex;
    gap: 10px; /* Ajoute un petit espace entre les boutons */
    width: 100%; /* Ensures the container takes full width */
    justify-content: space-between; /* Distributes space between buttons */
    flex-wrap: wrap; /* Allows buttons to wrap on smaller screens */
}

@media (max-width: 992px) {
    .btn {
        padding: 10px 20px; /* Réduit légèrement le padding */
        font-size: 13px; /* Réduit légèrement la taille de la police */
    }
}

@media (max-width: 768px) {
    .btn {
        padding: 8px 10px; /* Padding plus petit pour les petits écrans */
        font-size: 12px; /* Taille de police réduite pour une meilleure adaptation */
    }
}
</style>
@endsection
