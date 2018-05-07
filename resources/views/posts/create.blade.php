@extends('layouts.theme')

@section('content')
    <h1>Create</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
    <div class="form-group">
        {{Form::label('desc', 'Description')}}
        {{Form::textarea('desc', '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::file('image')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection