
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="" type="submit">Se déconnecter</button>
</form>

<form method="POST" action="/createtask/{{ $workspace->id }}">
    @csrf
    <input type="text" name="name" placeholder="Nom de la tâche">

    <input type="text" name="description" placeholder="Déscription de la tâche" size="20" maxlength="30">

    {{-- <input type="date" name="date" placeholder="Date de création"> --}}

    <select name="importance">
        <option selected disabled>--Choisissez le type de contrat--</option>
        <option value="Pas Urgent">Pas urgent</option>
        <option value="Peu Urgent">Peu urgent</option>
        <option value="Urgence">Urgent</option>
        <option value="Urgence modéré">Très urgent</option>
        <option value="Urgence prioritaire">À faire en priorité !</option>
    </select>

    <input type="submit" name='sub' value="Enregistrer">
</form>

@foreach ($workspace->tasks as $task)
    <br>
    <div>
        <b>Nom de la tache :</b> {{$task->name}} <br>
        <b>Description :</b> {{$task->description}} <br>
        <b>Importance :</b> {{$task->importance}} <br>
        <b>Créateur :</b> {{$task->creator}} <br>
        <b>Date :</b> {{$task->created_at}} <br>
    </div>
    <form action="/edit/{{$task["id"]}}" method="GET">
        @csrf
        <button type="submit" class="">Modifier la tâche</button>
    </form>
    
    <form action="/delete/{{$task["id"]}}" method="POST">
        @csrf
        <button type="submit" class="">Supprimer la tâche</button>
    </form>
    <br>
    <br>
@endforeach