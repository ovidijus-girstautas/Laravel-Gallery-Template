@extends('layouts.theme')

@section('content')
    <div class="col-lg-12">
    <a href="/top" style="text-decoration:none;"><h3>Top Rated</h3></a>
    @foreach($likes as $like)
        <div class=" col-md-4 col-sm-6 co-xs-6 gal-item image-gallery2">
            <div class="hover-image-relate">
                <a href="/posts/{{$like->id}}"><img src="/storage/images/{{$like->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
                <h3 class="hover-image-title"><a href="/posts/{{$like->id}}">{{$like->title}}</a></h3>
                <small class="orange">Uploaded by <a class="uploaded-by" href="/userProfile/{{$like->name}}">{{$like->name}}</a></small>
            </div>
        </div>
    @endforeach
    </div>

    <div class=" col-lg-12">
    <h3><a href="/posts" style="text-decoration:none;">Latest Uploads</a></h3>
    @foreach($posts_latest as $post)
        <div class=" col-md-4 col-sm-6 co-xs-6 gal-item image-gallery2">
            <div class="">
                <a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
                {{--<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>--}}
                <small class="orange">Uploaded by <a class="uploaded-by" href="/userProfile/{{$post->user->name}}">{{$post->user->name}}</small>
            </div>
        </div>
    @endforeach
    </div>

@endsection