
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="" type="submit">Se déconnecter</button>
</form>

<form method="POST" enctype="multipart/form-data" action="/createworkspace">
    @csrf
    Nom de l'espace de travail: <input type="text" name="workspace_name">
    Image de couverture (optionnel): <input type="file" id="workspace_cover" name="workspace_cover" accept="image/png, image/jpeg">
    <button type="submit">Créer l'espace de travail</button>
</form>

<h3>Vos tableaux</h3>

@foreach($user->workspaces as $workspace)
    @if($workspace->workspace_cover_name == null)
        <img src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="default-workspace-image">
    @else
        <img src="{{ asset('storage/uploads/'.$workspace->workspace_cover_name) }}" alt="">
    @endif
    <br>
    {{ $workspace->workspace_name }}
    <br>
    @foreach($user->workspaces as $workspace)
        @if ($workspace->pivot->isAdmin == 1 || $workspace->pivot->ownership == 1)
            <form method="GET" action="/managemembers/{{ $workspace->id }}">
                @csrf
                <button class="" type="submit">Gérer les membres</button>
            </form>
        @endif
    @endforeach
    @foreach($user->workspaces as $workspace)
        @if ($workspace->pivot->isAdmin == 1 || $workspace->pivot->ownership == 1)
            <form method="GET" action="/editworkspace/{{ $workspace->id }}">
                @csrf
                <button class="" type="submit">Modifier le tableau</button>
            </form>
        @endif
    @endforeach
    @foreach($user->workspaces as $workspace)
        @if ($workspace->pivot->ownership == 1)
            <form method="POST" action="/deleteworkspace/{{ $workspace->id }}" onclick="return confirm('Vous voulez supprimer le tableau ? (En cliquant sur OK, tout sera supprimé définitivement)')">
                @csrf
                <button class="" type="submit">Supprimer le tableau</button>
            </form>
        @endif
    @endforeach
@endforeach