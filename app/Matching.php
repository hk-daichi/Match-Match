<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Matching extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'matching_request',
        ];
    public function user(){
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }
}