<?php

namespace App\Http\Controllers\Panel;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
   public function index()
   {
        return view('users.index')->with([
            'users' => User::all(),
        ]);
   }

   public function toggleAdmin(User $user)
   {
        if($user->isAdmin())
        {
            $user->admin_since = null;
        }
        else
        {
            $user->admin_since = now();
        }
        $user->save();
        return redirect()->route('users.index')->with('success', "Admin status for user {$user->id} was toggled");


   }
}
