@extends('components.layout')
@section('content')

<form method="POST" enctype="multipart/form-data" action="/createworkspace">
    @csrf
    Nom de l'espace de travail: <input type="text" name="workspace_name">
    Image de couverture (optionnel): <input type="file" id="workspace_cover" name="workspace_cover" accept="image/png, image/jpeg">
    <button type="submit">Créer l'espace de travail</button>
</form>

<h3>Vos tableaux</h3>

@foreach($user->workspaces as $workspace)
    <a href="workspace/{{ $workspace->id }}">
        @if($workspace->workspace_cover_name == null)
            <img src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="default-workspace-image">
        @else
            <img src="{{ asset('workspaceimgs/'.$workspace->workspace_cover_name) }}" alt="">
        @endif
    </a>
    <br>
    <h1>{{ $workspace->workspace_name }}</h1>
    <br>

    <form method="GET" action="/managemembers/{{ $workspace->id }}">
        @csrf
        <button class="" type="submit">Gérer les membres</button>
    </form>

    @if ($workspace->pivot->isAdmin == 1 || $workspace->pivot->ownership == 1)
        <form method="GET" action="/editworkspace/{{ $workspace->id }}">
            @csrf
            <button class="" type="submit">Modifier le tableau</button>
        </form>
    @endif
    @if ($workspace->pivot->ownership == 1)
        <form method="POST" action="/deleteworkspace/{{ $workspace->id }}" onclick="return confirm('Vous voulez supprimer le tableau ? (En cliquant sur OK, tout sera supprimé définitivement)')">
            @csrf
            <button class="" type="submit">Supprimer le tableau</button>
        </form>
    @endif
@endforeach

@endsection