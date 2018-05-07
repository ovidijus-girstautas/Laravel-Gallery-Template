<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes(){
        return $this->hasMany('App\Likes');
    }

    public function liked_by_auth_user(){
        $id = auth()->user()->id;
        $likers = array();

        foreach($this->likes as $like):
            array_push($likers, $like->user_id);
        endforeach;

        if(in_array($id, $likers )){
            return true;
        }else{
            return false;
        }

    }
}
