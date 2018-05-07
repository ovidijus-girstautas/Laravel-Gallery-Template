<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\News;
use App\Comments;
use App\Likes;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('adminRole');
    }

    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.admin')->with('posts', $posts);
    }


    public function news(){

        $news = News::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.news')->with('news', $news);
    }

    public function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function show(){

        $posts = Post::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.posts')->with('posts', $posts);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
            'image' => 'image|required|max:5000'
        ]);

        // Handle image upload
        if($request->hasFile('image')){
            //Get filename

            $filenameWithExt = $request->file('image')->getClientOriginalName();

            //Get just the name

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension

            $extension = $request->file('image')->getClientOriginalExtension();

            //create filename to store

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);


        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        //create post
        $post = new News;
        $post->title = $request->input('title');
        $post->desc = $request->input('desc');
        $post->image = $fileNameToStore;
        $post->save();

        return redirect('/admin/news')->with('success', 'Post Submited');
    }

    public function destroy($id)
    {
        $post = News::find($id);
        $post->delete();
        return redirect('/admin/news')->with('success', 'News Post removed...');

    }

    public function edit($id)
    {
        $posts = News::find($id);

        return view('admin.edit')->with('posts', $posts);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required'
        ]);

        $post = News::find($id);
        $post->title = $request->input('title');
        $post->desc = $request->input('desc');
        $post->save();

        return redirect('/admin/news')->with('success', 'News Post Updated!');
    }

    public function ban(Request $request, $id){

        $ban = User::find($id);
        $ban->isBanned = $request->input('isBanned');
        $ban->save();

        return redirect('/admin/users');

    }

    public function unban(Request $request, $id){

        $ban = User::find($id);
        $ban->isBanned = $request->input('isBanned');
        $ban->save();

        return redirect('/admin/users');

    }
}
