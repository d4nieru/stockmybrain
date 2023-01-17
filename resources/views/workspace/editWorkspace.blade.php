@extends('components.layout')
@section('content')

<p>Vous etes en train de modifier le tableau <b>{{ $workspace->workspace_name }}</b> {{ $workspace }} </p>
<br>

<form method="POST" enctype="multipart/form-data" action="/posteditworkspace/{{ $workspace->id }}">
    @csrf
    Nouveau nom de l'espace de travail: <input type="text" name="new_workspace_name">
    Nouvelle Image de couverture (optionnel): <input type="file" id="new_workspace_cover" name="new_workspace_cover" accept="image/png, image/jpeg">
    <button type="submit">Effectuer les modifications</button>
</form>

@endsection