<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Chat_room_user extends Model
{
    protected $fillable = [
        'chat_room_id', 'user_id',
    ];
    
    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
