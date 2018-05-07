@extends('layouts.theme')

@section('content')
    <div class="card col-lg-12">
        <h1>Top Rated</h1>
        @foreach($likes as $like)
            <div class="card col-md-3 col-sm-6 col-xs-6 gal-item image-gallery">
                <div class="">
                    <a href="/posts/{{$like->id}}"><img src="/storage/images/{{$like->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
                    {{--<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>--}}
                    <small>Uploaded by {{$like->name}}</small>
                </div>
            </div>
        @endforeach
        <div class="col-lg-12 col-md-12 col-xs-12">
            {{$likes->links()}}
        </div>
    </div>
@endsection