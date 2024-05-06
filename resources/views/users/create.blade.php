@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Créer un utilisateur</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="#">Admin</a></li> <!-- Assurez-vous de corriger le lien si nécessaire -->
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header" style="background-color:#17a2b8 ; color: white;">
                    Informations de l'utilisateur
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <select class="form-select" id="role" name="role">
                                <option value="" disabled selected>Choisir un rôle</option>
                                <option value="chercheur">Chercheur</option>
                                <option value="enseignant">Enseignant</option>
                                <option value="etudiant">Étudiant</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                            @error('mdp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mdp_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="mdp_confirmation" name="mdp_confirmation" required>
                            @error('mdp_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                           <button type="submit" class="btn btn-outline-primary">Créer</button>
                            <a href="{{ route('users.list') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
