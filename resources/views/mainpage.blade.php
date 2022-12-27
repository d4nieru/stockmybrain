
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-secondary btn-sm" type="submit">Se déconnecter</button>
</form>

<form method="POST" enctype="multipart/form-data" action="/createworkspace">
    @csrf
    Nom de l'espace de travail: <input type="text" name="workspace_name">
    Image de couverture (optionnel): <input type="file" id="workspace_cover" name="workspace_cover" accept="image/png, image/jpeg">
    <button type="submit">Créer l'espace de travail</button>
</form>

<p>Vos espaces de travail</p>

@foreach($user->workspaces as $workspace)
    @if($workspace->pivot->workspace_cover_name == null)
        <img src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="default-workspace-image">
    @else
        <img src="{{ asset('storage/uploads/'.$workspace->pivot->workspace_cover_name) }}" alt="">
    @endif
    <br>
    {{ $workspace->workspace_name }}
    <br>
    <form method="POST" action="/deleteworkspace/{{ $workspace->id }}">
        @csrf
        <button type="submit">Supprimer</button>
    </form>
@endforeach