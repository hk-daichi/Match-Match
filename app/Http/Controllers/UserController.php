<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('profiles/index')->with(['users' => $user->getPaginateByLimit()]);
    }
    public function profile(User $user){
        return view('profiles/profile')->with(['user' => $user]);
    }
    public function profile_edit(User $user){
        return view('profiles/profile_edit')->with(['user' => $user]);
    }
    public function update(Request $request, User $user){
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        
        return redirect('/profile/' . Auth::user()->id);
    }
}