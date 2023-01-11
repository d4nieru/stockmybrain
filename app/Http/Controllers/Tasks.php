<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class Tasks extends Controller
{
    public function formulaire () {

        return view ("formulaire");

    }

    public function liste_task () {
        // $user_id=Auth::id();
        $tasks = Task::all();

        return view ("liste", compact("tasks"));

    }

    public function createtask (Request $request)
    {

        $request->validate([
            "nom"=>"required",
            "description"=>"required",
            "importance"=>"required"
        ]);

        $user_id = Auth::id();

        $taskname = $request->input("nom");
        $taskdescr = $request->input("description");
        $taskimp = $request->input("importance");

        $task = new Task ();

        $task->name=$taskname;
        $task->description=$taskdescr;
        $task->importance=$taskimp;
        $task->creator=$user_id;

        $task->save();

        return redirect("/liste");

    }

    public function delete($id){

        $task = Task::find($id);

        $task->delete();

        return redirect("/liste");
    }

    public function edit($id){

        $task = Task::find($id);

        return view("edit", compact("task"));
    }

    public function editid(Request $request,$id){


        $task = Task::find($id);
        
        $task->name = $request->input("nom");
        $task->description = $request->input("description");
        $task->importance = $request->input("importance");
        $task->save();

        return redirect("/liste");
    }
}
