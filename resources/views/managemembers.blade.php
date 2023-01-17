@include('nav')
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

<h1>GERER LES UTILISATEURS</h1>

@foreach($workspace->users as $usern)
    @if($usern->id == $user_id) <b>(Vous)</b> @endif {{ $usern->name }} - ({{ $usern->email }}) 

    @if($usern->pivot->ownership == 1) - <b>Propriétaire</b> 
    @elseif($usern->pivot->isAdmin == 1) - <b>Administrateur</b> 
    @else - <b>Collaborateur</b>
    @endif
    <br>
    @if($usern->id != $user_id)
        <form method="POST" action="/transferownership/{{ $workspace->id }}/{{ $usern->id }}/{{ $user_id }}"
            onclick="return confirm('Vous voulez vraiment transférer de propriété ? (En cliquant sur OK, vous ne serez plus propriétaire du tableau)')">
            @csrf
            <button class="" type="submit">Transférer la propriété</button>
        </form>
        <form method="POST" action="/removeuserfromworkspace/{{ $workspace->id }}/{{ $usern->id }}/{{ $user_id }}"
            onclick="return confirm('Vous voulez vraiment le retirer ? (En cliquant sur OK, il/elle ne fera plus parti(e))')">
            @csrf
            <button class="" type="submit">Retirer l'utilisateur du projet</button>
        </form>
    @else
        
    @endif
    <br>
@endforeach