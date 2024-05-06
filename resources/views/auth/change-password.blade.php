@extends('layouts.app')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Profil</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('profile') }}">Profil</a></li>
            </ol>
        </div>
    </div>
</section>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="{{ route('profile') }}">Profil</a>
        <a class="nav-link active ms-0" href="{{ route('change.password') }}">Mot de Passe</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- Change password card-->
            <div class="card mb-4">
                <div class="card-header">Changer le MDP</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="currentPassword" class="small mb-1">MDP actuel</label>
                            <input class="form-control" id="currentPassword" type="password" name="current_password" placeholder="Mot de passe actuel">
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="small mb-1">Nouveau MDP</label>
                            <input class="form-control" id="newPassword" type="password" name="new_password" placeholder="Nouveau mot de passe">
                            @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="small mb-1">Confirmer le MDP</label>
                            <input class="form-control" id="confirmPassword" type="password" name="new_password_confirmation" placeholder="Confirmez le mot de passe">
                        </div>
                        <button class="btn btn-primary" type="submit">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Security preferences card-->
            <div class="card mb-4">
                <div class="card-header">Préférences de sécurité</div>
                <div class="card-body">
         
                    <!-- Data sharing options-->
                    <h5 class="mb-1">Partage de données</h5>
            <p class="small text-muted">Le partage de données d'utilisation peut nous aider à améliorer nos produits et à mieux servir nos utilisateurs lorsqu'ils naviguent sur notre application. Lorsque vous acceptez de partager des données d'utilisation avec nous, les rapports d'erreurs et les analyses d'utilisation seront automatiquement envoyés à notre équipe de développement pour enquête.</p>
            <form>
                <div class="form-check">
                    <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage" checked="">
                    <label class="form-check-label" for="radioUsage1">Oui, partager des données et des rapports d'erreurs avec les développeurs d'applications</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                    <label class="form-check-label" for="radioUsage2">Non, limiter le partage de mes données avec les développeurs d'applications</label>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body{margin-top:20px;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}

.btn-danger-soft {
    color: #000;
    background-color: #f1e0e3;
    border-color: #f1e0e3;
}
</style>
@endsection
