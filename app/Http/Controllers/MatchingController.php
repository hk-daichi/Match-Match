<?php

namespace App\Http\Controllers;

use App\User;
use App\Matching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    public function matching_request(Request $request){
        Matching::create([
            'from_user_id'=>Auth::user()->id,
            'to_user_id'=>$request->input('to_user_id'),
            'matching_request'=>$request->input('matching_request'),
        ]);
        
        return redirect('/profile/' . $request->input('to_user_id'));
    }
    public function matching_list(Matching $matching){
        //$recieved_ids = 自分にリクエストを送ったユーザーのid
        $recieved_id=$matching->where('to_user_id', '=', Auth::user()->id)
                                ->where('matching_request', true)
                                ->pluck('from_user_id');
        //$matched_users_relation = 自分にリクエストを送ったユーザーに自分もリクエストを送ったユーザー = マッチしたユーザー(matchingsテーブルのデータ)
        $matched_users_relation=$matching->where('from_user_id', '=', Auth::user()->id)
                                            ->whereIn('to_user_id', $recieved_id)
                                            ->where('matching_request', true)
                                            ->get();
        return view('profiles/matching_list')->with(['matched_users_relations' => $matched_users_relation]);
    }
}