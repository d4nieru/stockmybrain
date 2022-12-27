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

        return redirect("/home");

    }
}
