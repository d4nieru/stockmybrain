<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;

class Tasks extends Controller
{

    public function createTask(Request $request, $workspaceid)
    {

        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "importance"=>"required"
        ]);

        $user_id = Auth::id();
        $usern = Auth::user();
        $u = $usern->name;

        $taskname = $request->input("name");
        $taskdescr = $request->input("description");
        $taskimp = $request->input("importance");

        $task = new Task();

        $task->name = $taskname;
        $task->description = $taskdescr;
        $task->importance = $taskimp;
        $task->creator = $u;
        $task->status = "Non Fait";

        $task->save();

        $workspace = Workspace::find($workspaceid);
        $workspace->tasks()->attach($workspaceid, ['task_id' => $task->id, 'user_id' => $user_id]);

        return back();

    }

    public function deleteTask($id) 
    {

        $task = Task::find($id);

        $task->delete();

        return back();
    }

    public function editTask($id) 
    {
        $task = Task::find($id);

        $title = $task->name." | Stock My Brain";

        return view("task.editTask", compact('title', 'task'));
    }

    public function postEditTask(Request $request, $id)
    {
        $task = Task::find($id);
        
        $task->name = $request->input("name");
        $task->description = $request->input("description");
        $task->importance = $request->input("importance");
        $task->save();

        return back();
    }

    public function changeTaskStatus(Request $request, $id)
    {
        $task = Task::find($id);

        $request->validate([
            "taskStatus"=>"required"
        ]);

        $taskStatus = $request->input("taskStatus");

        $task->status = $taskStatus;
        $task->save();

        return back();
    }
}
