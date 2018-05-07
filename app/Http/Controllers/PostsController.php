<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comments;

class PostsController extends Controller
{
    /**
     * PostsController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('posts.index')->with('posts', $posts);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $post = new Post;
        $post->title = $request->input('title');
        $post->desc = $request->input('desc');
        $post->user_id = auth()->user()->id;
        $post->image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Submited');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $posts = Post::find($id);
        $comments = $posts->comments()->with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('posts.show')->with('posts', $posts)->with('comments', $comments);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);

        if(auth()->user()->id !== $posts->user_id){
            return redirect('/posts')->with('error', 'Access Denied');

        }

        return view('posts.edit')->with('posts', $posts);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->save();

        return redirect('/posts')->with('success', 'Description updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Image removed...');

    }
}
