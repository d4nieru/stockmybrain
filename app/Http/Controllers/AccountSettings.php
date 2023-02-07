<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountSettings extends Controller
{
    public function accountSettings()
    {
        $title = "Paramètres | Stock My Brain";

        $user_id = Auth::id();

        $user = User::find($user_id);

        return view('accountsettings.accountsettings', compact('title', 'user'));
    }
}
