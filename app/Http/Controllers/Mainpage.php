<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;

class Mainpage extends Controller
{
    public function home()
    {
        $user_id = Auth::id();

        $user = User::find($user_id);

        return view('mainpage', compact('user'));
    }

    public function createWorkspace(Request $request)
    {
        $request->validate([
            'workspace_name' => 'required',
            'workspace_cover' => 'file|mimes:jpeg,jpg,png'
        ]);

        $workspace_cover_name = null;
        $workspace_cover_path = null;

        if ($request->hasFile('workspace_cover')) {

            $workspace_cover_name = $request->file('workspace_cover')->getClientOriginalName();
            $workspace_cover_path = $request->file('workspace_cover')->storeAs('public/uploads', $workspace_cover_name);
        }

        $workspace_name = $request->input("workspace_name");
        $user_id = Auth::id();

        $workspace = new Workspace();
        $workspace->workspace_name = $workspace_name;
        $workspace->workspace_cover_name = $workspace_cover_name;
        $workspace->workspace_cover_path = $workspace_cover_path;
        $workspace->save();

        $workspace_id = $workspace->id;

        $user = User::find($user_id);
        $user->workspaces()->attach($workspace_id, ['ownership' => 1, 'isAdmin' => 1]);

        return redirect('/home');
    }

    public function deleteWorkspace($id)
    {
        $workspace = Workspace::findOrFail($id);

        foreach ($workspace->users as $worksp) {
            $filename = $worksp->workspace_cover_name;
        }

        if(is_file( public_path() . "/storage/uploads/" . $filename))
        {
            Storage::delete($filename);

            unlink(storage_path('app/public/uploads/' . $filename));
        }

        $workspace->users()->detach();
        $workspace->delete();

        return redirect('/home');
    }

    public function editWorkspace($id)
    {
        $workspace = Workspace::find($id);

        return view('editworkspacepage', compact('workspace'));
    }

    public function postEditWorkspace(Request $request, $id)
    {
        $request->validate([
            'new_workspace_name' => 'sometimes',
            'new_workspace_cover' => 'sometimes|file|mimes:jpeg,jpg,png'
        ]);

        if ($request->input("new_workspace_name") && !$request->hasFile('new_workspace_cover')) {

            $new_workspace_name = $request->input("new_workspace_name");
            Workspace::where('id', $id)->update(['workspace_name' => $new_workspace_name]);

            return redirect('/home');
        
        } else if (!$request->input("new_workspace_name") && $request->hasFile('new_workspace_cover')) {

            $workspace_cover_name = $request->file('new_workspace_cover')->getClientOriginalName();
            $workspace_cover_path = $request->file('new_workspace_cover')->storeAs('public/uploads/', $workspace_cover_name);
            Workspace::where('id', $id)->update(['workspace_cover_name' => $workspace_cover_name, 'workspace_cover_path' => $workspace_cover_path]);

            return redirect('/home');

        } else {

            return back();

        }
    }

    public function accessWorkspace($id)
    {
        $user_id = Auth::id();

        $workspace = Workspace::find($id);

        $user = User::find($user_id);

        return view('tasklist', compact('workspace', 'user', 'user_id'));
    }

    
}