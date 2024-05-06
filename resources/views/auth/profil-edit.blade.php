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
        <a class="nav-link active ms-0" href="{{ route('profile') }}">Profil</a>
        <a class="nav-link ms-0" href="{{ route('change.password') }}">Mot de Passe</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
       <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Photo de Profil</div>
                <div class="card-body text-center">
                    <!-- Image de profil -->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ Auth::user()->profile_image }}" alt="Photo de profil" id="profile_image_preview">
                    <!-- Aide pour la photo de profil -->
                    <div class="small font-italic text-muted mb-4">JPG ou PNG max 5 MB</div>
                    <!-- Formulaire de téléversement d'image -->
                    <form method="POST" action="{{ route('upload.profile.image') }}" enctype="multipart/form-data" id="upload_form">
                        @csrf
                        <input type="file" name="profile_image" accept="image/*" id="profile_image_input" style="display: none;">
                        <!-- Le label déclenchera le click sur le input file -->
                        <label for="profile_image_input" class="btn btn-primary">Choisir une image</label>
                    </form>
                </div>
            </div>
        </div>
            <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Détails du Profil</div>
                <div class="card-body">
                    <form action="{{ route('updateProfile') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ Auth::user()->nom }}">
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ Auth::user()->prenom }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail :</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    // Lorsque l'utilisateur sélectionne une image, déclencher automatiquement le téléversement du formulaire
    document.getElementById('profile_image_input').addEventListener('change', function() {
        document.getElementById('upload_form').submit();
    });
</script>
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
</style>
@endsection
