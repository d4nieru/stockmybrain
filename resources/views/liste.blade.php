@foreach ($tasks as $task)

Nom de la tache : {{$task->name}} <br>
Description : {{$task->description}} <br>
Importance : {{$task->importance}} <br>
Créateur : {{$task->creator}} <br>
Date : {{$task->created_at}} <br>

<form action="/edit/{{$task["id"]}}" method="get">
    @csrf
    <button type="submit" class="btn btn-default">Edit</button>
</form>

<form action="delete/{{$task["id"]}}" method="post">
    @csrf
    <button type="submit" class="btn btn-default">delete</button>
</form>

<br><br>

@endforeach