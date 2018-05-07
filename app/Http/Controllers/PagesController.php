<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\News;
use App\Comments;
use App\Likes;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home(){

        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        $comments = Comments::orderBy('created_at', 'desc')->take(1)->get();

        return view('pages.home')->with('posts', $posts)->with('news', $news)->with('comments', $comments);
    }

    public function news(){

        $news = $news = News::orderBy('created_at', 'desc')->paginate(12);
        return view('pages.news')->with('news', $news);
    }

    public function show($id)
    {

        $news = News::find($id);
        return view('pages.show')->with('news', $news);

    }

    public function gallery(){

// RAW SQL QUERY FOR REFERENE --------------------------------
//        $likes = DB::select("
//                  SELECT count(likes.post_id) AS AllCount, posts.id, posts.image, posts.user_id, users.name, posts.title
//                  FROM posts, likes, users
//                  WHERE likes.post_id = posts.id AND posts.user_id = users.id
//                  GROUP BY likes.post_id, posts.id, posts.image, posts.user_id, users.name, posts.title
//                  ORDER BY AllCount DESC
//                  LIMIT 0,3
//                  ");
//------------------------------------------------------------

        $likes = Post::
            select(DB::raw('count(likes.post_id) as AllCount, posts.id, posts.image, posts.user_id, users.name, posts.title'))
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('likes', 'likes.post_id','=','posts.id')
            ->groupBy('likes.post_id')
            ->orderBy('AllCount', 'DESC')
            ->take(3)
            ->get();


        $posts_latest = Post::orderBy('created_at', 'desc')->take(12)->get();
        return view('pages.gallery')->with('posts_latest', $posts_latest)->with('likes', $likes);
    }

    public function top(){

        $likes = Post::
        select(DB::raw('count(likes.post_id) as AllCount, posts.id, posts.image, posts.user_id, users.name, posts.title'))
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('likes', 'likes.post_id','=','posts.id')
            ->groupBy('likes.post_id')
            ->orderBy('AllCount', 'DESC')
            ->paginate(12);


        return view('pages.top')->with('likes', $likes);
    }


    public function posts(){

        return view('posts.index');
    }

}
