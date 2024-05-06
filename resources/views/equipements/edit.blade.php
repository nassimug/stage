@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Modifier l'Équipement : <strong>{{ $equipement->nom }}</strong></h2>
            <ol>
                <li><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('equipements.index') }}"> Équipements</a></li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<div class="container mt-4" style="margin-bottom:20px;">
    <div class="card shadow">
        <div class="card-header" style="background-color:#17a2b8; color: white;">
            Détails de l'Équipement
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('equipements.update', $equipement->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'Équipement</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $equipement->nom }}" required>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    @if($equipement->images)
                        <div class="mt-2">
                            @foreach($equipement->images as $image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($image->path) }}" alt="Image de l'équipement" style="width: 100px;">
                                <button class="btn btn-danger btn-sm" onclick="deleteImage({{ $image->id }})">Supprimer</button>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="myeditorinstance" name="description" required>{!! $equipement->description !!}</textarea>
                </div>
                <div class="mb-3">
            <label for="aperçu" class="form-label">Aperçu</label>
            <textarea class="form-control" id="myeditorinstance" name="aperçu">{!! $equipement->aperçu !!}</textarea>
        </div>
        <!-- TinyMCE Editor pour les spécifications -->
        <div class="mb-3">
            <label for="spécifications" class="form-label">Spécifications</label>
            <textarea class="form-control" id="myeditorinstance" name="spécifications">{!! $equipement->spécifications !!}</textarea>
        </div>
        <!-- TinyMCE Editor pour les caractéristiques -->
        <div class="mb-3">
            <label for="caractéristiques" class="form-label">Caractéristiques</label>
            <textarea class="form-control" id="myeditorinstance" name="caractéristiques">{!! $equipement->caractéristiques !!}</textarea>
        </div>
        <!-- TinyMCE Editor pour l'utilisation -->
        <div class="mb-3">
            <label for="utilisation" class="form-label">Utilisation</label>
            <textarea class="form-control" id="myeditorinstance" name="utilisation">{!! $equipement->utilisation !!}</textarea>
        </div>
        <!-- TinyMCE Editor pour les téléchargements -->
        <div class="mb-3">
            <label for="téléchargements" class="form-label">Téléchargement</label>
            <textarea class="form-control" id="myeditorinstance" name="téléchargements">{!! $equipement->téléchargements !!}</textarea>
        </div>
                
                <button type="submit" class="btn btn-outline-primary">Modifier</button>
            </form>
        </div>
    </div>
</div>

<script>
function deleteImage(imageId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
        $.ajax({
            url: "{{ url('images') }}/" + imageId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: "DELETE"
            },
            success: function(result) {
                alert('Image supprimée avec succès');
                location.reload(); // Pour rafraîchir la page et refléter la suppression
            },
        });
    }
}
</script>

<!-- Script TinyMCE -->
<x-head.tinymce-config/>
@endsection
