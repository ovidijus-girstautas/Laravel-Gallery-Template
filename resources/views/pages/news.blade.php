@extends('layouts.theme')

@section('content')
    @foreach($news as $new)
        <div class="well">
            <h1 class="display-3 linkit"><a class="linkit" href="/news/{{$new->id}}">{{$new->title}}</a></h1>
            <img src="/storage/images/{{$new->image}}" alt="" class="img-responsive">
            <p class="lead">{!! $new->desc !!}</p>
            <small class="uploaded-by">Uploaded at {{$new->created_at}}</small>
        </div>
    @endforeach
@endsection