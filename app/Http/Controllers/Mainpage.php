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

        //$user = Classroom::find($user_id);
        $user = User::find($user_id);
        return view('mainpage', compact('user'));
    }

    public function createworkspace(Request $request)
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
        $workspace->save();

        $workspace_id = $workspace->id;

        $user = User::find($user_id);
        $user->workspaces()->attach([$user_id => ['workspace_id' => $workspace_id, 'workspace_cover_name' => $workspace_cover_name, 'workspace_cover_path' => $workspace_cover_path]]);

        return redirect('/home');
    }

    public function deleteworkspace($id)
    {
        $workspace = Workspace::findOrFail($id);

        foreach ($workspace->users as $worksp) {
            $filename = $worksp->pivot->workspace_cover_name;
        }

        if(is_file( public_path() . "/storage/uploads/" . $filename))
        {
            Storage::delete($filename);

            unlink(storage_path('app/public/uploads/'.$filename));
        }

        $workspace = Workspace::findOrFail($id);
        $workspace->users()->detach();
        $workspace->delete();

        return redirect('/home');
    }
}
