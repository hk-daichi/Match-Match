<?php

namespace App\Http\Controllers;

use App\User;
use App\Matching;
use App\Chat_room_user;
use App\Chat_room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    public function matching_request(Request $request)
    {
        Matching::create([
            'from_user_id'=>Auth::user()->id,
            'to_user_id'=>$request->input('to_user_id'),
            'matching_request'=>$request->input('matching_request'),
        ]);
        $page_request=$request->input('page_request');
        if($page_request==0){
            return redirect('/profile/' . $request->input('to_user_id'));
        }else{
            return redirect('/matching_list');
        }
    }
    
    public function matching_delete(Request $request, Matching $matching)
    {
        $from_user_id=$request->input('from_user_id');
        $to_user_id=$request->input('to_user_id');
        $matching_to_remove=$matching->where('from_user_id', '=', $from_user_id)
                                        ->where('to_user_id', '=', $to_user_id);
        $matching_to_remove->delete();
        $page_request=$request->input('page_request');
        if($page_request==0){
            return redirect('/profile/' . $to_user_id);
        }
        else{
            return redirect('/matching_list');
        }
    }
    
    public function matching_list(Matching $matching, User $user, Chat_room $chat_room, Chat_room_user $chat_room_user)
    {
        //$recieved_ids = 自分にリクエストを送ったユーザーのid
        $recieved_ids=$matching->where('to_user_id', '=', Auth::user()->id)
                                ->where('matching_request', true)
                                ->pluck('from_user_id');
        //$sent_ids = 自分がリクエストを送ったユーザーのid
        $sent_ids=$matching->where('from_user_id', '=', Auth::user()->id)
                            ->where('matching_request', true)
                            ->pluck('to_user_id');
        //$recieved_only_ids = 自分がリクエストを受け、相手には送っていないユーザーのid
        $recieved_only_ids=array();
        if($sent_ids->isEmpty()){
            foreach($recieved_ids as $recieved_id){
                array_push($recieved_only_ids, $recieved_id);
            }
        }else{
            foreach($recieved_ids as $recieved_id){
                $count=0;
                foreach($sent_ids as $sent_id){
                    if($recieved_id==$sent_id){
                        $count=$count+1;
                    }
                }
                if($count==0){
                    array_push($recieved_only_ids, $recieved_id);
                }
            }
        }
        //$recieved_users_relation = 自分はリクエストを送っていないが自分にリクエストを送ったユーザー = マッチングリクエストユーザー(matchingsテーブルのデータ)
        $recieved_users_relation=$user->whereIn('id',  $recieved_only_ids)
                                            ->get();
        //$matched_users_relation = 自分にリクエストを送ったユーザーに自分もリクエストを送ったユーザー = マッチしたユーザー(matchingsテーブルのデータ)
        $matched_users_relation=$matching->where('from_user_id', '=', Auth::user()->id)//自分が送った
                                            ->whereIn('to_user_id', $recieved_ids)//かつ相手からも送られた
                                            ->where('matching_request', true)
                                            ->get();
        //自分が持っているチャットルーム
        $chat_room_ids=$chat_room_user->where('user_id', '=', Auth::user()->id)
                                            ->pluck('chat_room_id')
                                            ->toArray();
        //自分とチャットが成立しているuser_id
        $chat_user_ids=$chat_room_user->whereIn('chat_room_id', $chat_room_ids)
                                        ->where('user_id', '!=', Auth::user()->id)
                                        ->pluck('user_id')
                                        ->toArray();
        return view('profiles/matching_list')->with(['recieved_users_relations' => $recieved_users_relation])
                                            ->with(['matched_users_relations' => $matched_users_relation])
                                            ->with('chat_user_ids', $chat_user_ids);
    }
}