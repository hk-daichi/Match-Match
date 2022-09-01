<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function getByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    public function getPaginateByLimit(int $limit_count = 5){
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
