<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Chat_message extends Model
{
    protected $fillable = [
        'message', 'user_id',
        'chat_room_id',
    ];
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
