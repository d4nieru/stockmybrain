@foreach ($tasks as $task)

Nom de la tache : {{$task->name}} <br>
Description : {{$task->description}} <br>
Importance : {{$task->importance}} <br>
Créateur : {{$task->creator}} <br>
Date : {{$task->created_at}}

<br><br>

@endforeach