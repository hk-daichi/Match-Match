<?php

namespace App\Http\Controllers;

use App\User;
use App\Matching;
use App\Chat_message;
use App\Chat_room_user;
use App\Chat_room;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('profiles/index')->with(['users' => $user->getPaginateByLimit()]);
    }
    
    public function my_profile(User $user)
    {
        return view('profiles/my_profile')->with(['user' => $user]);
    }
    
    public function profile(User $user, Matching $matching, Chat_room $chat_room, Chat_room_user $chat_room_user)
    {
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
        $chat_room_id_user1=$chat_room_user->where('user_id', '=', Auth::user()->id)
                                            ->pluck('chat_room_id')
                                            ->toArray();
        $chat_room_id_user2=$chat_room_user->where('user_id', '=', $user->id)
                                            ->pluck('chat_room_id')
                                            ->toArray();
        //$chat_room_existence = チャットルームが存在するかどうか(ture:存在しない or false:存在する)
        $chat_room_existence=empty(array_intersect($chat_room_id_user1, $chat_room_id_user2));
        return view('profiles/profile')->with(['user' => $user])->with('sent', $sent)->with('matched', $matched)->with('chat_room_existence', $chat_room_existence);
    }
    
    public function profile_edit(User $user)
    {
        return view('profiles/profile_edit')->with(['user' => $user]);
    }
    
    public function update(Request $request, User $user)
    {
        $input_user=$request['user'];
        $this->validator($input_user)->validate();
        $image=$request->file('image');
        if(isset($image)){
            // 現在の画像ファイルの削除
            Storage::disk('s3')->delete(Auth::user()->img_url);
            // バケットへアップロード
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            //DBの更新
            $user->update(['img_url' => $path]);
        }
        $user->fill($input_user)->save();
        return redirect('/my_profile/' . Auth::user()->id);
    }
    
    public function edit_profile_image(User $user){
        return view('profiles/edit_profile_image')->with(['user' => $user]);
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:20'],
            'age' => ['required'],
            'facility' => ['required', 'string', 'max:30'],
            'years_of_experience' => ['required'],
            'career' => ['required', 'string', 'max:30'],
            'purpose' => ['required', 'string', 'max:30'],
        ]);
    }
}