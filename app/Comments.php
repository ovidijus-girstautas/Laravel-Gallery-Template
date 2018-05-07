<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $primaryKey = 'id';

    public $timestamps = true;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
