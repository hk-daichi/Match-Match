<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat_message;
use App\Chat_room_user;
use App\Chat_room;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChatController extends Controller
{
    public function index(Chat_message $chat_message, Chat_room_user $chat_room_user, User $user)
    {
        
        $chat_room_id_user1=$chat_room_user->where('user_id', '=', Auth::user()->id)
                                            ->pluck('chat_room_id')
                                            ->toArray();
        $chat_room_id_user2=$chat_room_user->where('user_id', '=', $user->id)
                                            ->pluck('chat_room_id')
                                            ->toArray();
        $chat_room_id_array=array_intersect($chat_room_id_user1, $chat_room_id_user2);
        $chat_room_id=array_shift($chat_room_id_array);
        $chat_room_messages=$chat_message->where('chat_room_id', '=', $chat_room_id)
                                            ->get();
        return view('chats/index')->with(['chat_room_messages' => $chat_room_messages])->with(['chat_room_id' => $chat_room_id])->with(['user' => $user]);
    }
    public function create_chat_room(Request $request)
    {
        Chat_room::create();
        $created_chat_room_id=Chat_room::orderBy('created_at', 'desc')->first()->id;
        Chat_room_user::create([
            'chat_room_id'=>$created_chat_room_id,
            'user_id'=>Auth::user()->id,
        ]);
        Chat_room_user::create([
            'chat_room_id'=>$created_chat_room_id,
            'user_id'=>$request->input('the_other_id'),
        ]);
        return redirect('chat/' . $request->input('the_other_id'));
    }
    public function message_store(Request $request)
    {
        Chat_message::create([
            'message'=>$request->input('message'),
            'user_id'=>Auth::user()->id,
            'chat_room_id'=>$request->input('chat_room_id'),
        ]);
        return redirect('chat/' . $request->input('the_other_id'));
    }
    public function chat_post_method(Request $request){
        if($request->input('function_num')==0){
            Chat_room::create();
            $created_chat_room_id=Chat_room::orderBy('created_at', 'desc')->first()->id;
            Chat_room_user::create([
                'chat_room_id'=>$created_chat_room_id,
                'user_id'=>Auth::user()->id,
            ]);
            Chat_room_user::create([
                'chat_room_id'=>$created_chat_room_id,
                'user_id'=>$request->input('the_other_id'),
            ]);
            return redirect('chat/' . $request->input('the_other_id'));
        }
        else{
            Chat_message::create([
            'message'=>$request->input('message'),
            'user_id'=>Auth::user()->id,
            'chat_room_id'=>$request->input('chat_room_id'),
            ]);
            return redirect('chat/' . $request->input('the_other_id'));
        }
    }
}
