@extends('layouts.theme')

@section('content')

    <div class="height">
        <div class="col-lg-8 float-left">
            @guest
            <h1 class="display-3">Welcome to Gallery.test</h1>
            <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-lg btn-success" href="/register" role="button">Register now</a></p>
            @endguest
            <br>
            <a class="display-3 uploaded-by" href="/news" class="home-page" style="text-decoration:none; color: black;"><h1>News</h1></a>
            <div class="well">
            @foreach($news as $new)
                <div class="well">
                    <h1 class="display-3"><a class="linkit" href="/news/{{$new->id}}">{{$new->title}}</a></h1>
                    <small class="grey">Uploaded at {{$new->created_at}}</small>

                </div>
            @endforeach
            </div>

        </div>


    <div class="col-lg-4 float-right">
        <a class="display-3" href="/posts" class="home-page" style="text-decoration:none; color: black;"><h3>Newest uploads</h3></a>
        <div class="well">

        @if(count($posts)>0)
            @foreach($posts as $post)
                <div class="well">
                    <a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
                    <small class="uploaded-by" >Uploaded by {{$post->user->name}}</small>
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
    </div>


@endsection
