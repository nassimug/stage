@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Détails de la réservation</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('reservations.index') }}">Réservations</a></li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<div class="container my-5">
    <div class="card mb-4 shadow">
        <div class="card-header " style= "background-color:#17a2b8 ; color: white;">
            Détails de la réservation de l'équipement: <strong>{{ $reservation->equipement->nom }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($reservation->equipement->images->isNotEmpty())
                    <img src="{{ Storage::url($reservation->equipement->images->first()->path) }}" class="img-fluid" alt="Image de l'équipement">
                    @else
                    <img src="{{ asset('path/to/default-image.jpg') }}" class="img-fluid" alt="Image par défaut">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Client : </th>
                                    <td>{{ $reservation->nom }} {{ $reservation->prenom }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email : </th>
                                    <td>{{ $reservation->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date d'emprunt : </th>
                                    <td>{{ $formattedDateDebut }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de réstitution : </th>
                                    <td>{{ $formattedDateFin }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Commentaire : </th>
                                    <td>{{ $reservation->commentaire ?: 'Aucun commentaire fourni.' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernière mise à jour : </th>
                                    <td>{{ $reservation->updated_at->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

