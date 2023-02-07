@extends('components.layout')
@section('content')

<form method="POST" action="/createtask/{{ $workspace->id }}">
    @csrf
    <input type="text" name="name" placeholder="Nom de la tâche">

    <input type="text" name="description" placeholder="Déscription de la tâche" size="20" maxlength="30">

    {{-- <input type="date" name="date" placeholder="Date de création"> --}}

    <select name="importance">
        <option selected disabled>--Choisissez l'importance de la tâche'--</option>
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
        <b>Etat :</b> {{$task->status}}

        @foreach ($connectedUser->workspaces as $u)
            {{-- Si l'utilisateur est propriétaire du tableau, il aura une option en plus dans le menu déroulant --}}
            @if($u->pivot->ownership == 1)
                <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                    @csrf
                    <select name="taskStatus">
                        <option selected disabled>--Choisissez l'etat de la tâche--</option>
                        <option value="Non Fait">Non Fait</option>
                        <option value="En Cours">En Cours</option>
                        <option value="Terminé (Non Vérifié)">Terminé (Non Vérifié)</option>
                        <option value="Terminé (Vérifié)">Terminé (Vérifié)</option>
                    </select>
                    <input type="submit" name='sub' value="Enregistrer">
                </form>
            @else
                <form method="POST" action="/changetaskstatus/{{ $task["id"] }}">
                    @csrf
                    <select name="taskStatus">
                        <option selected disabled>--Choisissez l'etat de la tâche--</option>
                        <option value="Non Fait">Non Fait</option>
                        <option value="En Cours">En Cours</option>
                        <option value="Terminé (Non Vérifié)">Terminé (Non Vérifié)</option>
                    </select>
                    <input type="submit" name='sub' value="Enregistrer">
                </form>
            @endif
        @endforeach
    </div>
    <form action="/edittask/{{$task["id"]}}" method="GET">
        @csrf
        <button type="submit" class="">Modifier la tâche</button>
    </form>
    
    <form action="/deletetask/{{$task["id"]}}" method="POST">
        @csrf
        <button type="submit" class="">Supprimer la tâche</button>
    </form>
    <br>
    <br>
@endforeach

@endsection