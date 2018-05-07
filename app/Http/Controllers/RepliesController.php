<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Likes;
use App\User;

class RepliesController extends Controller
{

    public function index()
    {
        $likes = Likes::orderBy('created_at', 'desc')->paginate(20);
        return view('posts.show')->with('likes', $likes);
    }

    public function store(Request $request){

        $likes = new Likes;
        $likes->post_id = $request->input('id');
        $likes->user_id = auth()->user()->id;
        $likes->save();

        return redirect()->back();
    }


    public function destroy($id){
        $likes = Likes::where('post_id', $id)->where('user_id', auth()->user()->id)->first();
        $likes->delete();
        return redirect()->back();
    }

}
