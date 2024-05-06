@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Accepter la Réservation de <strong>{{ $reservation->equipement->nom }}</strong> pour <strong>{{ $reservation->nom }} {{ $reservation->prenom }}</strong></h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('reservations.index') }}">Réservations</a></li>
         
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header" style= "background-color:#17a2b8 ; color: white;">
                    Soumettre un Commentaire
                </div>
                <div class="card-body">
                    <form action="{{ route('reservations.accept', $reservation->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="commentaire" class="form-label">Commentaire :</label>
                            <textarea class="form-control" id="commentaire" name="commentaire" rows="3">{{ $reservation->commentaire }}</textarea>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-outline-primary">Accepter la réservation</button>
                            <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
