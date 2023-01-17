@extends('components.layout')
@section('content')

<h1>Modification de la Tâche</h1>

    <form action="/edittask/{{$task["id"]}}" method="post">
        @csrf

        <input type="text" name="name" placeholder="Nom de la tâche" value="{{ $task->name }}">

        <input type="text" name="description" placeholder="Déscription de la tâche" size="20" maxlength="30" value="{{ $task->description }}">

        {{-- <input type="date" name="date" placeholder="Date de création"> --}}

        <select name="importance">
            <option selected disabled>--Choisissez l'importance de la tâche'--</option>
            <option value="Pas Urgent">Pas urgent</option>
            <option value="Peu Urgent">Peu urgent</option>
            <option value="Urgence">Urgent</option>
            <option value="Urgence modéré">Très urgent</option>
            <option value="Urgence prioritaire">À faire en priorité !</option>
        </select>

        <input type="submit" name='sub' value="Enregistrer la modification">

    </form>

@endsection