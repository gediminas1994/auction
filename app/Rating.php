<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getRatingMakerUsername(){
        $user = User::find($this->rated_by_user_id);
        return $user->username;
    }
}
