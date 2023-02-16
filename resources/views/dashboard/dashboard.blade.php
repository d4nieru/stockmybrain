@extends('components.layout')
@section('content')

<form class="create-workspace-form" method="POST" enctype="multipart/form-data" action="/createworkspace">
    @csrf
    <label for="workspace-name-input">Nom de l'espace de travail:</label>
    <input type="text" id="workspace-name-input" name="workspace_name">
    <label for="workspace-cover-input">Image de couverture (optionnel):</label>
    <input type="file" id="workspace-cover-input" name="workspace_cover" accept="image/png, image/jpeg">
    <button type="submit" class="create-workspace-button">Créer l'espace de travail</button>
</form>

<h3 class="workspaces-heading">Vos tableaux</h3>

@foreach($user->workspaces as $workspace)
    <a href="workspace/{{ $workspace->id }}" class="workspace-link">
        @if($workspace->workspace_cover_name == null)
            <img src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="default-workspace-image" class="workspace-image">
        @else
            <img src="{{ asset('workspaceimgs/'.$workspace->workspace_cover_name) }}" alt="" class="workspace-image">
        @endif
    </a>
    <br>
    <h1 class="workspace-name">{{ $workspace->workspace_name }}</h1>
    <br>

    <form method="GET" action="/managemembers/{{ $workspace->id }}">
        @csrf
        <button class="manage-members-button" type="submit">Gérer les membres</button>
    </form>

    @if ($workspace->pivot->isAdmin == 1 || $workspace->pivot->ownership == 1)
        <form method="GET" action="/editworkspace/{{ $workspace->id }}">
            @csrf
            <button class="edit-workspace-button" type="submit">Modifier le tableau</button>
        </form>
    @endif
    @if ($workspace->pivot->ownership == 1)
        <form method="POST" action="/deleteworkspace/{{ $workspace->id }}" onclick="return confirm('Vous voulez supprimer le tableau ? (En cliquant sur OK, tout sera supprimé définitivement)')">
            @csrf
            <button class="delete-workspace-button" type="submit">Supprimer le tableau</button>
        </form>
    @endif
@endforeach

@endsection