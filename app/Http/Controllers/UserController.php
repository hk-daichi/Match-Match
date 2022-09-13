<?php

namespace App\Http\Controllers;

use App\User;
use App\Matching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('profiles/index')->with(['users' => $user->getPaginateByLimit()]);
    }
    public function my_profile(User $user){
        return view('profiles/my_profile')->with(['user' => $user]);
    }
    public function profile(User $user, Matching $matching){
        //$sent = マッチングリクエストを送ったかどうか(ture or false)
        $sent=Matching::where('from_user_id', '=', Auth::user()->id)
                        ->where('to_user_id', '=', $user->id)
                        ->where('matching_request', true)->exists();
        //$recieved = そのユーザーからマッチングリクエストを受け取ったかどうか(true or false)
        $recieved=Matching::where('from_user_id', '=', $user->id)
                            ->where('to_user_id', '=', Auth::user()->id)
                            ->where('matching_request', true)->exists();
        //$matched = マッチングが成立したかどうか
        $matched = ($sent and $recieved);
        return view('profiles/profile')->with(['user' => $user])->with('sent', $sent)->with('matched', $matched);
    }
    public function profile_edit(User $user){
        return view('profiles/profile_edit')->with(['user' => $user]);
    }
    public function update(Request $request, User $user){
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        
        return redirect('/my_profile/' . Auth::user()->id);
    }
}