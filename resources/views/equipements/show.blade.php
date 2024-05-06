@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container" >
        <div class="d-flex justify-content-between align-items-center">
            <h2>Équipements</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('equipements.index') }}"> Équipements</a></li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->
<div class="container">
    <hr>
    <div class="card">
        <div class="card-body" style="background-color: #f8f9fa;">
            <div class="row">
                <div class="col-md-6 image-hover-effect">
                    <div id="carouselEquipement{{ $equipement->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div id="productCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($equipement->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="...">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" 
                            data-bs-target="#carouselEquipement{{ $equipement->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden ">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselEquipement{{ $equipement->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>{!! $equipement->description !!}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $equipement->aperçu ? 'active' : '' }}" data-bs-toggle="tab" href="#aperçu">Aperçu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $equipement->spécifications ? '' : 'd-none' }}" data-bs-toggle="tab" href="#spécifications">Spécifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $equipement->caractéristiques ? '' : 'd-none' }}" data-bs-toggle="tab" href="#caractéristiques">Caractéristiques</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $equipement->utilisation ? '' : 'd-none' }}" data-bs-toggle="tab" href="#utilisation">Utilisation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $equipement->téléchargements ? '' : 'd-none' }}" data-bs-toggle="tab" href="#téléchargements">Téléchargements</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="aperçu" class="container tab-pane {{ $equipement->aperçu ? 'active' : '' }}"><br>
            <p>{!! $equipement->aperçu !!}</p>
        </div>
        <div id="spécifications" class="container tab-pane {{ $equipement->spécifications ? '' : 'd-none' }}"><br>
            <p>{!! $equipement->spécifications !!}</p>
        </div>
        <div id="caractéristiques" class="container tab-pane {{ $equipement->caractéristiques ? '' : 'd-none' }}"><br>
            <p>{!! $equipement->caractéristiques !!}</p>
        </div>
        <div id="utilisation" class="container tab-pane {{ $equipement->utilisation ? '' : 'd-none' }}"><br>
            <p>{!! $equipement->utilisation !!}</p>
        </div>
        <div id="téléchargements" class="container tab-pane {{ $equipement->téléchargements ? '' : 'd-none' }}"><br>
            <p>{!! $equipement->téléchargements !!}</p>
        </div>
    </div>
</div>

</div>
<style>
.image-hover-effect img {
    transition: transform 0.3s ease-in-out;
}

.image-hover-effect:hover img {
    transform: scale(1.05);
}

.nav-link {
    position: relative;
    color: #17a2b8 !important;
}

.nav-link::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: -5px;
    left: 0;
    background-color: transparent;
    transition: all 0.3s ease-in-out;
    
}

.nav-link.active::after,
.nav-link:hover::after {
    background-color: #17a2b8 !important; /* Couleur de votre choix */
    bottom: -2px;
}
.nav-link.active {
    color: #17a2b8 !important; /* Couleur de votre choix */
}


</style>
@endsection
