<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
