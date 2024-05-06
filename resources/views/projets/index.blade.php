@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Liste des projets</h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li>Admin</li>

            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4" style="margin-top:-20px;">
            <!--------------------- FILTRE ------------------------>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                    style="background-color: #17a2b8; color:white;">
                    <i class="bi bi-filter-left" style="color:white"></i> Filtre
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('projets.index', ['plateforme' => '']) }}">Tous</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('projets.index', ['plateforme' => 'terrestre']) }}">Plateforme Terrestre</a>
                    </li>
                    <li><a class="dropdown-item"
                            href="{{ route('projets.index', ['plateforme' => 'drone']) }}">Plateforme Drone</a></li>
                </ul>
            </div>

            <!---------------------- Create Projet ----------------------->
            <div class="btn-group">
    <a href="{{ route('projets.create') }}" class="btn" style="margin: 20px 0px 20px 0px; background-color: #17a2b8; color:white;">
        <i class="bi bi-file-earmark-plus" style="color:white;"></i> Créer un projet
    </a>
</div>



            <div class="card">
                <div class="card-body">
                    <!---------------------------- Barre de recherche --------------->
                    <form action="{{ route('projets.index') }}" method="GET" class="d-flex">
    <input class="form-control me-2" type="search" name="search" placeholder="Recherche" aria-label="Search" value="{{ request()->search ?? '' }}">
    <button class="btn btn-outline-primary" type="submit">Chercher</button>
</form>

                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>Nom du Projet</span></th>
                                        <th><span>Plateforme</span></th>
                                        <th><span>Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projets as $projet)
                                    <tr>
                                        <td>
                                            <a href="{{ route('projets.show', $projet->id) }}" class="user-link" style="color: #3498db;">{{ $projet->nom }}</a>
                                        </td>
                                        <td>
                                            {{ optional($projet->plateforme)->type ?? 'Non spécifié' }}
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="{{ route('projets.show', $projet->id) }}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x" style="color: #3498db;"></i>
                                                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a href="{{ route('projets.edit', $projet->id) }}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x" style="color: #3498db;"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <form action="{{ route('projets.destroy', $projet->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-link danger"
                                                    style="border: none; background: none; padding: 0;"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x" style="color: #fe635f;"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination justify-content-center">
                {{ $projets->links() }}
            </div>
        </div>
    </div>
</div>


<style>
body {
    margin-top: 20px;
}


/* USER LIST TABLE */
.user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
}

.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}

.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}

/* TABLES */
.table {
    border-collapse: separate;
}

.table-hover>tbody>tr:hover>td,
.table-hover>tbody>tr:hover>th {
    background-color: #eee !important;
}

.table thead>tr>th {
    border-bottom: 1px solid #C2C2C2;
    padding-bottom: 0;
}

.table tbody>tr>td {
    font-size: 0.875em;
    background: #f5f5f5 !important;
    border-top: 10px solid #fff;
    vertical-align: middle;
    padding: 12px 8px;
}

.table tbody>tr>td:first-child,
.table thead>tr>th:first-child {
    padding-left: 20px;
}

.table thead>tr>th span {
    border-bottom: 2px solid #C2C2C2;
    display: inline-block;
    padding: 0 5px;
    padding-bottom: 5px;
    font-weight: normal;
}

.table thead>tr>th>a span {
    color: #344644;
}

.table thead>tr>th>a span:after {
    content: "\f0dc";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    margin-left: 5px;
    font-size: 0.75em;
}

.table thead>tr>th>a.asc span:after {
    content: "\f0dd";
}

.table thead>tr>th>a.desc span:after {
    content: "\f0de";
}

.table thead>tr>th>a:hover span {
    text-decoration: none;
    color: #2bb6a3;
    border-color: #2bb6a3;
}

.table.table-hover tbody>tr>td {
    -webkit-transition: background-color 0.15s ease-in-out 0s !important;
    transition: background-color 0.15s ease-in-out 0s !important;
}

.table tbody tr td .call-type {
    display: block;
    font-size: 0.75em;
    text-align: center;
}

.table tbody tr td .first-line {
    line-height: 1.5;
    font-weight: 400;
    font-size: 1.125em;
}

.table tbody tr td .first-line span {
    font-size: 0.875em;
    color: #969696;
    font-weight: 300;
}

.table tbody tr td .second-line {
    font-size: 0.875em;
    line-height: 1.2;
}

.table a.table-link {
    margin: 0 5px;
    font-size: 1.125em;
}

.table a.table-link:hover {
    text-decoration: none;
    color: #2aa493 !important;
}

.table a.table-link.danger {
    color: #fe635f !important;
}

.table a.table-link.danger:hover {
    color: #dd504c !important;
}

.table-products tbody>tr>td {
    background: none !important;
    border: none;
    border-bottom: 1px solid #ebebeb;
    -webkit-transition: background-color 0.15s ease-in-out 0s !important;
    transition: background-color 0.15s ease-in-out 0s !important;
    position: relative;
}

.table-products tbody>tr:hover>td {
    text-decoration: none;
    background-color: #f6f6f6 !important;
}

.table-products .name {
    display: block;
    font-weight: 600;
    padding-bottom: 7px;
}

.table-products .price {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
}

.table-products .price>i {
    color: #8dc859;
}

.table-products .warranty {
    display: block;
    text-decoration: none;
    width: 50%;
    float: left;
    font-size: 0.875em;
}

.table-products .warranty>i {
    color: #f1c40f;
}

.table tbody>tr.table-line-fb>td {
    background-color: #9daccb !important;
    color: #262525;
}

.table tbody>tr.table-line-twitter>td {
    background-color: #9fccff !important;
    color: #262525;
}

.table tbody>tr.table-line-plus>td {
    background-color: #eea59c !important;
    color: #262525;
}

.table-stats .status-social-icon {
    font-size: 1.9em;
    vertical-align: bottom;
}

.table-stats .table-line-fb .status-social-icon {
    color: #556484;
}

.table-stats .table-line-twitter .status-social-icon {
    color: #5885b8;
}

.table-stats .table-line-plus .status-social-icon {
    color: #a75d54;
}

.label-success {
    background-color: #5cb85c;
}

.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}

/* Style général des cartes et des éléments */
.container {
    padding-top: 20px;
}

.card {
    border: 1px solid #dee2e6;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    position: relative;
}

/* Style pour la barre de recherche et les sélecteurs */
.input-select {
    padding: 6px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    background-color: white;
}

.input-text {
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    width: 100%;
}

.btn-search {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 8px 12px;
    margin-left: 10px;
    border-radius: 0.25rem;
    cursor: pointer;
}

/* Style du bouton de création d'utilisateur */
.btn-primary {
    float: right;
    background-color: #0069d9;
    border-color: #0062cc;
}

/* Réponse au hover sur les boutons */
.btn-primary:hover,
.btn-search:hover {
    opacity: 0.85;
}

/* Style de la table */
.table-responsive {
    margin-top: 20px;
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
@endsection