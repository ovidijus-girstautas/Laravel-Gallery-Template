@extends('layouts.theme')

@section('content')
    <div class="well col-lg-12">
        <a href="javascript:history.back()" class="btn btn-lg btn-info">Return</a>
        @guest
        <button class="btn btn-lg btn-success pull-right">{{$posts->likes->count()}} Likes</button>
        @else
        @if($posts->liked_by_auth_user())

            <form action="{{route('likes.destroy', $posts->id)}}" class="pull-right" method="POST">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                {{Form::hidden('id', $posts->id)}}
                {{Form::submit('Unlike', ['class' => 'btn btn-lg btn-warning'])}}
                <span class="btn btn-lg btn-warning">{{$posts->likes->count()}}</span>
            </form>
        @else
            <form action="{{route('likes.store', $posts->id)}}" class="pull-right" method="POST">
                {{csrf_field()}}
                {{Form::hidden('id', $posts->id)}}
                {{Form::submit('Like', ['class' => 'btn btn-lg btn-success'])}}
            </form>
        @endif
        @endguest

        <h1>{{$posts->title}}</h1>
        <img src="/storage/images/{{$posts->image}}" class="img-thumbnail img-responsive" alt="">
    </div>

    <div class="well" style="min-height: 250px">
        <div class="col-lg-12 jumbotron padding" style="height: 100%;">
            <img class="col-lg-2 col-xs-4" src="/storage/images/{{$posts->user->avatar}}" alt="AVATAR">
            <h5 class="orange">Uploaded by <a class="uploaded-by" href="/userProfile/{{$posts->user->name}}">{{$posts->user->name}}</a></h5>
            <h5 class="grey">On {{$posts->created_at}}</h5>
        </div>

        <div class="col-lg-12 jumbotron padding" style="height: 100%;">
            <h5>{!! $posts->desc!!}</h5>
        </div>
    </div>
    <hr>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $posts->user_id)
    <a href="/posts/{{$posts->id}}/edit" class="btn btn-default"> Edit </a>

    {!!Form::open(['action' => ['PostsController@destroy', $posts->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
        @endif
    @endif


    <h3>Comment Section</h3>
    @guest
    <div class="card">
        <p>To comment, please log in.</p>
    </div>
    @else
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}

        <div class="form-group">
            {{Form::textarea('body', '', ['class' => 'form-control textarea', 'placeholder' => 'Your comment here...'])}}
        </div>
        {{Form::hidden('id', $posts->id)}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    @endguest
    <br>
    <div class="card">
        @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="well comment">
                <h5 class="orange">Comment by <a class="uploaded-by" href="/userProfile/{{$comment->user->name}}">{{$comment->user->name}}</a></h5>
                <p>{{$comment->comment}}</p>
            </div>
        @endforeach
        @else
            <div class="well">
        <p>No comments found.</p>
            </div>
        @endif
            <div class="col-lg-12">
                {{$comments->links()}}
            </div>
    </div>
@endsection