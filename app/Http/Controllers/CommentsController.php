<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comments;

class CommentsController extends Controller
{

    public function store(Request $request)
    {
        $this->validate( $request, [
            'body' => 'required|max:1000|min:20'
        ]);

        $comment = new Comments();
        $comment->comment = $request->input('body');
        $comment->post_id = $request->input('id');
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted!');

    }

}
