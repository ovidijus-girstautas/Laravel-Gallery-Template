@extends('layouts.theme')

@section('content')
    <h1>Images</h1>

    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="col-md-3 col-sm-6 col-xs-6 gal-item image-gallery">
                <div class="">
                    <a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
                    {{--<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>--}}
                    <small>Uploaded by <a class="uploaded-by" href="/userProfile/{{$post->user->name}}">{{$post->user->name}}</a></small>
                </div>
            </div>
        @endforeach
        <div class="col-lg-12 col-md-12 col-xs-12">
        {{$posts->links()}}
        </div>
    @else
        <p>No images found.</p>
    @endif
@endsection