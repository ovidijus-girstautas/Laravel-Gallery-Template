<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\News;
use App\Comments;
use App\Likes;
use Illuminate\Support\Facades\DB;
use App\User;

class UserProfileController extends Controller
{
//    public function index(){
//        $posts = Post::find($id)->paginate(20);
//        return view('profile.index')->with('posts', $posts);
//    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($username)
    {

       $user = User::whereName($username)->first();
       $likes = DB::table('users')
           ->where('name', '=', $user->name)
           ->first();

        $posts = DB::table('posts')
            ->where('posts.user_id', '=', $likes->id)
            ->take(12)->get();


        return view('profile.index')->with('user', $user)->with('posts', $posts)->with('likes', $likes);

    }

    public function userPosts($id)
    {

        $posts = DB::table('posts')
            ->where('posts.user_id', '=', $id)
            ->paginate(20);


        return view('profile.userPosts')->with('posts', $posts);

    }

    public function edit($id)
    {
        $posts = User::find($id);

        if(auth()->user()->id !== $posts->id){
            return redirect('/posts')->with('error', 'Access Denied');

        }

        return view('profile.edit')->with('posts', $posts);

    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'about' => 'required',
            'avatar' => 'image|required|max:2000'
        ]);

        if($request->hasFile('avatar')){

            // DELETE OLD AVATAR


            //Get filename

            $filenameWithExt = $request->file('avatar')->getClientOriginalName();

            //Get just the name

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension

            $extension = $request->file('avatar')->getClientOriginalExtension();

            //create filename to store

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('avatar')->storeAs('public/images', $fileNameToStore);


        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        $post = User::find($id);
        $name = $post->name;
        $post->about = $request->input('about');
        $post->avatar = $fileNameToStore;
        $post->save();

        return redirect('/userProfile/'.$name)->with('success', 'Profile Updated!');
    }
}
