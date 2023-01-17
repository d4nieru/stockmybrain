<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class Mainpage extends Controller
{
    public function home()
    {
        $user_id = Auth::id();

        $user = User::find($user_id);

        return view('home.mainpage', compact('user'));
    }

    public function createWorkspace(Request $request)
    {
        $this->validate($request, [
            'workspace_name' => 'required',
            'workspace_cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $workspace_cover_name = null;
        $workspace_cover_path = null;

        if ($request->hasFile('workspace_cover')) {

            $image = $request->file('workspace_cover');
            $workspace_cover_name = time().'.'.$image->getClientOriginalExtension();
            
            $workspace_cover_path = public_path('/workspaceimgs');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($workspace_cover_path.'/'.$workspace_cover_name);

            //$workspace_cover_name = $request->file('workspace_cover')->getClientOriginalName();
            //$workspace_cover_path = $request->file('workspace_cover')->storeAs('public/uploads', $workspace_cover_name);
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
        $user->workspaces()->attach($workspace_id, ['ownership' => 1, 'admin' => 1]);

        return back();
    }

    public function deleteWorkspace($id)
    {
        $workspace = Workspace::findOrFail($id);

        $filename = $workspace->workspace_cover_name;
        
        if(File::exists('workspaceimgs/'.$filename)) {

            File::delete('workspaceimgs/'.$filename);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }

        $workspace->users()->detach();
        $workspace->delete();

        return back();
    }

    public function editWorkspace($id)
    {
        $workspace = Workspace::find($id);

        return view('workspace.editWorkspace', compact('workspace'));
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

            $workspace = Workspace::findOrFail($id);

            $filename = $workspace->workspace_cover_name;
            
            if(File::exists('workspaceimgs/'.$filename)) {

                File::delete('workspaceimgs/'.$filename);
                /*
                    Delete Multiple File like this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }

            $image = $request->file('new_workspace_cover');
            $workspace_cover_name = time().'.'.$image->getClientOriginalExtension();
            $workspace_cover_path = public_path('/workspaceimgs');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($workspace_cover_path.'/'.$workspace_cover_name);

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

        $user = User::all();

        $connectedUser = User::find($user_id);

        return view('task.taskList', compact('workspace', 'user', 'user_id', 'connectedUser'));
    }
}