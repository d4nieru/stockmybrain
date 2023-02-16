@extends('components.layout')
@section('content')

<p>Vous vous trouvez sur le tableau : <b>{{ $workspace->workspace_name }}</b></p>
<br>

<h1>GERER LES UTILISATEURS</h1>

@foreach($workspace->users as $usern)

    @if($usern->pivot->ownership == 1 && $usern->id == $user_id)
        <form method="POST" enctype="multipart/form-data" action="/addusertoworkspace/{{ $workspace->id }}">
            @csrf
            Email: <input type="text" name="email">
            <button type="submit">Ajouter le membre dans l'espace de travail</button>
        </form>
        <br>
    @elseif ($usern->pivot->admin == 1 && $usern->id == $user_id)
        <form method="POST" enctype="multipart/form-data" action="/addusertoworkspace/{{ $workspace->id }}">
            @csrf
            Email: <input type="text" name="email">
            <button type="submit">Ajouter le membre dans l'espace de travail</button>
        </form>
        <br>
    @endif
    
@endforeach


@foreach($workspace->users as $usern)

    @if($usern->id == $user_id) <b>(Vous)</b> {{ $usern->name }} - ({{ $usern->email }}) | @if($usern->pivot->ownership == 1 || $usern->pivot->ownership == 1 && $usern->pivot->admin == 1) <b>Propriétaire</b>
    @elseif($usern->pivot->admin == 1) <b>Administrateur</b> @else <b>Collaborateur</b> @endif<br> @endif
    
@endforeach

<p>---</p>
<br>

@foreach($workspace->users as $usern)

    @foreach ($user->workspaces as $u)

        @if($u->pivot->ownership == 1 && $usern->id != $user_id)

            {{ $usern->name }} - ({{ $usern->email }}) | @if($usern->pivot->ownership == 1 || $usern->pivot->ownership == 1 && $usern->pivot->admin == 1) <b>Propriétaire</b>
            @elseif($usern->pivot->admin == 1) <b>Administrateur</b> @else <b>Collaborateur</b> @endif
        
            <form method="POST" action="/changerole/{{ $workspace->id }}/{{ $usern->id }}">
                @csrf
                <select name="userrole">
                    <option selected disabled>--Choisissez le role--</option>
                    <option value="Administrateur">Administrateur</option>
                    <option value="Collaborateur">Collaborateur</option>
                </select>
                <input type="submit" name='sub' value="Sauvegarder">
            </form>

            <form method="POST" action="/transferownership/{{ $workspace->id }}/{{ $usern->id }}"
                onclick="return confirm('Vous voulez vraiment transférer de propriété ? (En cliquant sur OK, vous ne serez plus propriétaire du tableau)')">
                @csrf
                <button type="submit">Transférer la propriété</button>
            </form>

            <form method="POST" action="/removeuserfromworkspace/{{ $workspace->id }}/{{ $usern->id }}"
                onclick="return confirm('Vous voulez vraiment le retirer ? (En cliquant sur OK, il/elle ne fera plus parti(e))')">
                @csrf
                <button type="submit">Retirer l'utilisateur du projet</button>
            </form>
            <br>
            <br>
        @elseif($u->pivot->ownership == 0 && $usern->id != $user_id)

            {{ $usern->name }} - ({{ $usern->email }}) | @if($usern->pivot->ownership == 1 || $usern->pivot->ownership == 1 && $usern->pivot->admin == 1) <b>Propriétaire</b>
            @elseif($usern->pivot->admin == 1) <b>Administrateur</b> @else <b>Collaborateur</b> @endif
            <br>
            <br>
        @endif

    @endforeach
    
@endforeach

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if (exist) {
      alert(msg);
    }
</script>

@endsection