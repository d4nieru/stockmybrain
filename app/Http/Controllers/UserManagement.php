<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;

class UserManagement extends Controller
{
    public function manageMembers($id)
    {
        $title = "Gérer les Membres | Stock My Brain";

        $user_id = Auth::id();

        $user = User::find($user_id);

        $workspace = Workspace::find($id);

        return view('workspace.manageMembers', compact('title', 'user', 'workspace', 'user_id'));
    }

    public function addUserToWorkspace(Request $request, $id)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $email = $request->input("email");

        $user = User::where('email', $email)->first();

        if ($user) {

            $user_id = $user->id;

            $workspace = Workspace::find($id);

            $workspace->users()->syncWithoutDetaching($user_id);

            return back();
            
        } else {

            return redirect()->back()->with('alert', "L'email n'existe pas dans notre base de données !");
        }

        
    }

    public function removeUserFromWorkspace($id, $listeduserid)
    {

        
        $workspace = Workspace::find($id);

        $user_id = Auth::id();

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        foreach($user1->workspaces as $u1) {
            foreach($user2->workspaces as $u2) {
                if($u1->pivot->ownership == 1 && $u2->pivot->ownership == 0 
                || $u1->pivot->isAdmin == 1 && $u2->pivot->isAdmin == 0) {

                    $workspace->users()->detach($listeduserid);
                    return back();
                    
                } else {
                    
                    return redirect()->back()->with('alert','Vous ne pouvez pas faire cette action : "Raison: Vous navez pas les permissions nécessaires !"');
                }
            }
        }
    }

    public function transferOwnership($id, $listeduserid)
    {

        $workspace = Workspace::find($id);

        $user_id = Auth::id();

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        foreach($user1->workspaces as $u1) {
            foreach($user2->workspaces as $u2) {
                if($u1->pivot->ownership == 1 && $u2->pivot->ownership == 0) {

                    $user1->workspaces()->updateExistingPivot($id, ['ownership' => 0]);
                    $user2->workspaces()->updateExistingPivot($id, ['ownership' => 1]);

                    return back();

                } else {

                    return redirect()->back()->with('alert','Vous ne pouvez pas faire cette action : "Raison: Vous navez pas les permissions nécessaires !"');
                }
            }
        }
    }

    public function changeRole(Request $request, $id, $listeduserid)
    {
        $user_id = Auth::id();

        $request->validate([
            "userrole"=>"required"
        ]);

        $importance = $request->input("userrole");

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        if($importance == "Administrateur") {

            foreach($user1->workspaces as $u1) {
                foreach($user2->workspaces as $u2) {
                    if($u1->pivot->ownership == 1 && $u2->pivot->ownership == 0) {
    
                        $user2->workspaces()->updateExistingPivot($id, ['admin' => 1]);
    
                        return back();
    
                    } else {
    
                        return redirect()->back()->with('alert','Vous ne pouvez pas faire cette action : "Raison: Vous navez pas les permissions nécessaires !"');
                    }
                }
            }

        } elseif ($importance == "Collaborateur") {

            foreach($user1->workspaces as $u1) {
                foreach($user2->workspaces as $u2) {
                    if($u1->pivot->ownership == 1 && $u2->pivot->ownership == 0) {
    
                        $user2->workspaces()->updateExistingPivot($id, ['ownership' => 0, 'admin' => 0]);
    
                        return back();
    
                    } else {
    
                        return redirect()->back()->with('alert','Vous ne pouvez pas faire cette action : "Raison: Vous navez pas les permissions nécessaires !"');
                    }
                }
            }

        } else {

            echo "ERROR";
        }
    }
}
