<p>Vous etes en train de modifier le tableau <b>{{ $workspace->workspace_name }}</b> {{ $workspace }} </p>
<br>

<form method="POST" enctype="multipart/form-data" action="/addusertoworkspace/{{ $workspace->id }}">
    @csrf
    Email: <input type="text" name="email">
    <button type="submit">Ajouter le membre dans l'espace de travail</button>
</form>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if (exist) {
      alert(msg);
    }
</script>

@foreach($workspace->users as $usern)
    @if($usern->id == $user_id)
        {{ $usern->name }} - ({{ $usern->email }}) <b>(Propriétaire)</b>
        <br>
        <br>
    @endif
    @if($usern->pivot->ownership == 0)
        {{ $usern->name }} - ({{ $usern->email }})
        <form method="POST" action="/removeuserfromworkspace/{{ $workspace->id }}/{{ $usern->id }}">
            @csrf
            <button class="" type="submit">Enlever l'utilisateur du projet</button>
        </form>
    @endif
@endforeach